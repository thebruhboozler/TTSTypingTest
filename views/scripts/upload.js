

let mediaRecorder;

function generateUniqueWordEntry(word){
	let entry = document.createElement("li")



	let recTitle = document.createElement("p");
	recTitle.innerText=word
	entry.appendChild(recTitle)
	
	let buttons = document.createElement("div")
	let recordBtn = document.createElement("button")

	recordBtn.addEventListener("click", async ()=>{
		let stream 
		try{
			steam = await navigator.mediaDevices.getUserMedia({audio: true})
		}catch(err){
			alert("microphne access denied")
		}
		mediaRecorder = new mediaRecorder(stream)
		
	})

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
