let words = []
let recordedChunks=[]
let mediaRecorder
//Lord forgive meee yeaaahhh


function generateUniqueWordEntry(word){
	let entry = document.createElement("li")



	let recTitle = document.createElement("p");
	recTitle.innerText=word
	entry.appendChild(recTitle)
	
	let buttons = document.createElement("div")
	let recordBtn = document.createElement("button")
	let recordIcon = document.createElement("img")

	recordIcon.src = "./views/assets/regular-microphone.svg"
	recordIcon.style.width = "35px"
	recordIcon.style.height = "35px"
	recordBtn.appendChild(recordIcon)
	buttons.appendChild(recordBtn)

	let uploadBtn =document.createElement("button")
	let uploadIcon = document.createElement("img")
	uploadIcon.src = "./views/assets/regular-paperclip.svg"

	uploadIcon.style.width = "35px"
	uploadIcon.style.height = "35px"

	uploadBtn.appendChild(uploadIcon)
	buttons.appendChild(uploadBtn)
	entry.appendChild(buttons)


	let audioInput = document.createElement("input")
	audioInput.type = "file"
	audioInput.style.display="none"
	audioInput.accept="audio/*"

	uploadBtn.addEventListener("click" , () => audioInput.click())
	entry.classList.add("wordRecording")
	entry.appendChild(audioInput)

	let audioPlayBack = document.createElement("audio");
	audioPlayBack.style.display="none"
	entry.appendChild(audioPlayBack)

	function addPlayBackButton(){
		let playPause = document.createElement('button')
		let playPauseIcon =document.createElement('img')
		playPauseIcon.src="./views/assets/regular-play.svg"
		playPauseIcon.style.width="35px"
		playPauseIcon.style.height="35px"
	
		audioPlayBack.addEventListener("ended",() => playPauseIcon.src="./views/assets/regular-play.svg" )
		playPause.appendChild(playPauseIcon)
		buttons.appendChild(playPause)

		playPause.addEventListener('click', () =>{
			if(playPauseIcon.src.includes("play")){
				audioPlayBack.play();
				playPauseIcon.src = "./views/assets/regular-pause.svg"
			}
			else {
				playPauseIcon.src ="./views/assets/regular-play.svg" 
				audioPlayBack.pause();
			}
		})
	}

	function addFileToWords(file, word){
		const found = words.find(e => e.word == word);
		if(!found) words.push({file,word})
		else{
			const index = words.indexOf(found);
			words[index] = { file, word };
		}
	}

	function updateRecordedWord(word){
		const file = words.find(e =>{ 
			return e.word == word
		}).file
		const url = URL.createObjectURL(file)
		audioPlayBack.src = url
	}
	recordBtn.addEventListener("click", async ()=>{
		if(mediaRecorder && mediaRecorder.state === 'recording'){
			await stopRecording(mediaRecorder)
			recordIcon.src = "./views/assets/icons-retry.svg"
			recordIcon.style.width="35px"
			recordIcon.style.height="35px"
		

			if(buttons.children.length != 3) {
				addPlayBackButton()
				return;
			}
			updateRecordedWord(word)			
			return
		}
		recordIcon.src = "./views/assets/solid-square.svg"
		recordIcon.style.width="15px"
		recordIcon.style.height="15px"
		recordedChunks = []
		let stream 
		try{
			stream = await navigator.mediaDevices.getUserMedia({audio: true})
		}catch(err){
			alert("microphne access denied")
		}
		mediaRecorder = new MediaRecorder(stream)
		mediaRecorder.ondataavailable = (e) =>{
			if(e.data.size > 0) recordedChunks.push(e.data)
		}
			
		function stopRecording(mediaRecorder){
			return new Promise((resolve)=>{
				mediaRecorder.onstop = () =>{
					const audio = new Blob(recordedChunks, {type: 'audio/webm'})
					const file = new File([audio], `${word}.webm`, {type: 'audio/webm'})
					addFileToWords(file, word)
					resolve()
				}
				mediaRecorder.stop()
			})
		}

		mediaRecorder.start()
	})


	audioInput.addEventListener("change", ()=>{
		console.log("stuff")
		if(audioInput.files.length <= 0) return
		console.log([...words])
		addFileToWords(audioInput.files[0], word)
		updateRecordedWord(word)
		if(buttons.children.length != 3) {
			addPlayBackButton()
		}
	})

	return entry
}

document.getElementById("textBtn").addEventListener("click" , async () => {
	let text = document.getElementById("textBtn").textContent
	let respone = await fetch("/api/uniqueWords" , {
		method: "POST",
		body: JSON.stringify({
			text: text,
		}),
	})
	let uniqueWords = []
	if(!respone.ok){
		uniqueWords = ["arch" , "linux" , "stuffy"]
	}
	
	let uniqueWordEntries = []
	uniqueWords.forEach( e => uniqueWordEntries.push(generateUniqueWordEntry(e)))
	
	let displayList = document.getElementById("recordings")
	displayList.innerHTML=''
	uniqueWordEntries.forEach( e => displayList.appendChild(e))
})
