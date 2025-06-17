async function config(){
	let id = null
	let endless = true

	await fetch('/random')
	.then( (e) =>{
		const url = new URL(e.url)
		id = url.searchParams.get('id')
	})
	return [id ,endless]
}
