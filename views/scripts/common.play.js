let btnDisplay=document.getElementById("btnMenu")
let textDisplay = document.getElementById("playArea")
let timerId=null
let timeDuration=0
let stopwatch = document.getElementById("stopwatch")
let cursor = document.createElement("span")
let player = document.getElementById("player")
let words =[];
let replay = () => player.play()
let currsorPos = 0
let currentWord = 0
let audioFiles = []
let endless
player.addEventListener("ended",replay)

cursor.classList.add('cursor')
cursor.innerText = "█"



let text = ""

function init(){
	words=text.split(' ')
	if(endless){
		//avriot sityvebi
		words.sort(()=> Math.random()-0.5)
		text = ""
		words.forEach((e)=> text += `${e} `)
		text=text.slice(0,-1)

		textDisplay.textContent=""
	}else{
		player.addEventListener("ended",replay)
		textDisplay.textContent="get ready to type!"
	}

	currentWord = 0
	player.src  = URL.createObjectURL(audioFiles.find((e) => e.word == words[currentWord]).content)
	currsorPos = 0
	btnMenu.style.display = 'none'
	btnMenu.classList.remove("animate")
}

function typeBehaviour(e){

	if(player.paused) player.play()
	if(timerId == null) timerId = setInterval(()=> {
		timeDuration++
		stopwatch.textContent = `${Math.floor(timeDuration/60)}:${(timeDuration%60).toString().padStart(2, '0')}`
	}, 1000)

	if(String.fromCharCode(e.keyCode) == text[currsorPos]){
		if(text[currsorPos+1] == ' '){
			currentWord++;
			player.src  = URL.createObjectURL(audioFiles.find((e) => e.word == words[currentWord]).content)
			player.play()
		}
		currsorPos++
	}

	let visibleText = text.slice(0,currsorPos)
	textDisplay.textContent = visibleText
	if(textDisplay.children.length == 0) textDisplay.appendChild(cursor)
	
	if(currsorPos >= text.length){
		if(endless){
			init()
			return
		}
		textDisplay.innerHTML=text
		player.removeEventListener("ended",replay)
		btnMenu.style.display = 'flex'
		btnMenu.classList.add('animate')
		clearInterval(timerId)
		timerId = null
		return
	}

}


async function setup(){
	let [id,_endless] = await config()
	console.log(id)
	endless = _endless
	fetch(`/api/getRun?id=${id}`)
	.then(res =>res.blob())
	.then(blob => JSZip.loadAsync(blob))
	.then(async zip =>{
		let audioPromises = []
		zip.forEach((relativePath , file)=>{
			if(relativePath.includes('text')) {
				file.async('text').then( content=> text =content)
				return
			}
			const promise = file.async('blob').then(content=>{
					let word = relativePath.split('.').shift() 
					audioFiles.push({word, content})
				})
			audioPromises.push(promise)
			})

		await Promise.all(audioPromises)
		}
	).then(() =>{
		init()
		window.addEventListener("keypress", typeBehaviour)
	})
}

setup();
document.getElementById("next").addEventListener("click", ()=>window.location.assign('/random'))
document.getElementById("home").addEventListener("click", ()=>window.location.assign('/home'))
