let btnDisplay=document.getElementById("btnMenu")
let textDisplay = document.getElementById("playArea")
let timerId=null
let timeDuration=0
let stopwatch = document.getElementById("stopwatch")
let cursor = document.createElement("span")
cursor.classList.add('cursor')
cursor.innerText = "█"


let text = ""
const params = new URLSearchParams(window.location.search);
const id = params.get('id');
let currsorPos = 0;
let currentWord = 0;
let audioFiles = [];


function getMimeTypeFromExtension(filename) {
	const ext = filename.split('.').pop().toLowerCase();
	const map = {
		'mp3': 'audio/mpeg',
		'wav': 'audio/wav',
		'ogg': 'audio/ogg',
		'webm': 'audio/webm',
	};
	return map[ext] || 'application/octet-stream';
}

fetch(`/api/getRun?id=${id}`)
.then(res =>res.blob())
.then(blob => JSZip.loadAsync(blob))
.then(async zip =>{
	let audioPromises = [];
	zip.forEach((relativePath , file)=>{
		if(relativePath.includes('text')) {
			file.async('text').then( content=> text =content);
			return;
		}
		const promise = file.async('blob').then(content=>{
				let word = relativePath.split('.').shift() 
				audioFiles.push({word, content});
			})
		audioPromises.push(promise)
		})

	await Promise.all(audioPromises)
	}
).then(() =>{
	let player = document.getElementById("player")
	const url = URL.createObjectURL(audioFiles[currentWord].content)
	player.src = url;
	let replay = () => player.play()
	player.addEventListener("ended",replay)

	
	window.addEventListener("keypress", (e)=>{
		if(player.paused) player.play()
		if(timerId == null) timerId = setInterval(()=> {
			timeDuration++
			stopwatch.textContent = `${Math.floor(timeDuration/60)}:${(timeDuration%60).toString().padStart(2, '0')}`
		}, 1000)

		

		if(String.fromCharCode(e.keyCode) == text[currsorPos]){
			if(text[currsorPos+1] == ' '){
				const url = URL.createObjectURL(audioFiles[++currentWord].content)
				player.src = url
				player.play()
			}
			currsorPos++
		}

		let visibleText = text.slice(0,currsorPos)
		textDisplay.textContent = visibleText
		if(textDisplay.children.length == 0) textDisplay.appendChild(cursor);
		
		if(currsorPos >= text.length) {
			textDisplay.innerHTML=text
			player.removeEventListener("ended",replay)
			btnMenu.style.display = 'flex'
			btnMenu.classList.add('animate')
			clearInterval(timerId)
			timerId = null
			return
		}

	})
})

document.getElementById("next").addEventListener("click", ()=>window.location.assign('/random'))
document.getElementById("retry").addEventListener("click", ()=>{
	currentWord = 0
	currsorPos = 0
	textDisplay.textContent="get ready to type!"
	timeDuration = 0
	stopwatch.textContent = `${Math.floor(timeDuration/60)}:${(timeDuration%60).toString().padStart(2, '0')}`
	btnMenu.style.display = 'none';
	btnMenu.classList.remove("animate");
})
document.getElementById("home").addEventListener("click", ()=>window.location.assign('/home'))
