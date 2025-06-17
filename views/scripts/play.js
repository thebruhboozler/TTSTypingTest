async function config(){
	const params = new URLSearchParams(window.location.search)
	const id = params.get('id')
	let endless=false
	return [id,endless]
}
