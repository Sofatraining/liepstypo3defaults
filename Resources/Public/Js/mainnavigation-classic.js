// Toggle Hamburger Menu
document.addEventListener('click',function(e){
	// Hamburger menu
	if(e.target.classList.contains('hamburger-toggle')){
		e.target.children[0].classList.toggle('active');
	}
}) 
