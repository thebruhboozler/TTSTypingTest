document.getElementById("signUpForm").addEventListener("submit" , (e) =>{

	let username=document.getElementById("username").value
	let passwd1=document.getElementById("password").value
	let passwd2=document.getElementById("repeatPassword").value
	console.log(passwd1)
	if(passwd1 != passwd2 || username.includes('@')) e.preventDefault()
})
