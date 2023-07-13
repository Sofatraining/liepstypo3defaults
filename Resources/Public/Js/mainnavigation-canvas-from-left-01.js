// Menügedöns
var elementsg1 = document.getElementsByClassName('grid-1')
var elementsg2 = document.getElementsByClassName('grid-2')
var elementsg3 = document.getElementsByClassName('grid-3')
		
const closeButton = document.querySelector('.btn-offcanvas-close')
closeButton.addEventListener('click', () => {
	toggleFirstElements.forEach((element) => {
		element.classList.remove('active')
		for (var i = 0; i < elementsg2.length; i++) {
			elementsg2[i].style.display = ''
		}
	})
	toggleSecondElements.forEach((element) => {
		element.classList.remove('active')
		for (var i = 0; i < elementsg3.length; i++) {
			elementsg3[i].style.display = ''
		}
	})
})
		
const toggleFirstButtons = document.querySelectorAll('.first-dropdown-toggle')
const toggleFirstElements = document.querySelectorAll('.childmenu')
const outputMainHeadline = document.querySelectorAll('.mainhead')
let buttonText
toggleFirstButtons.forEach((button) => {
	button.addEventListener('click', () => {
		toggleFirstButtons.forEach((button) => {
			button.classList.remove('selected')
		})
			
		toggleFirstButtons.forEach((otherButton) => {
			if (
				otherButton.getAttribute('data-target') ===
				button.getAttribute('data-target')
			) {
				otherButton.classList.add('selected')
				button.classList.add('selected')
			}
		})
			
		toggleSecondElements.forEach((element) => {
			if (element.id.startsWith('subchild')) {
				element.classList.remove('active')
			}
		})

		toggleFirstElements.forEach((element) => {
			element.classList.remove('active')
			element.classList.remove('selected')
			if (
				button.getAttribute('data-target') ===
				element.getAttribute('data-target')
			) {
				element.classList.toggle('active')
			}
		})
			
		buttonText = button.textContent
		outputMainHeadline.forEach((output) => {
			if (
				output.getAttribute('data-target') ===
				button.getAttribute('data-target')
			) {
				output.textContent = `${buttonText}`
			}
		})
	})
})
		
const toggleSecondButtons = document.querySelectorAll('.second-dropdown-toggle')
const toggleSecondElements = document.querySelectorAll('.childchildmenu')
const outputChildHeadline = document.querySelectorAll('.childhead')
toggleSecondButtons.forEach((button) => {
	button.addEventListener('click', () => {
		toggleSecondButtons.forEach((button) => {
			button.classList.remove('selected')
		})
		
		button.classList.add('selected')
		
		toggleSecondElements.forEach((element) => {
			element.classList.remove('active')
		})
		
		toggleSecondElements.forEach((element) => {
			if (
				button.getAttribute('data-target') ===
				element.getAttribute('data-target')
			) {
				element.classList.toggle('active')
			}
		})
		
		buttonText = button.textContent
		outputChildHeadline.forEach((output) => {
			if (
				output.getAttribute('data-target') ===
				button.getAttribute('data-target')
			) {
				output.textContent = `${buttonText}`
			}
		})
	})
})
		
const childMenuCloser = document.querySelectorAll('.childmenucloser')
const childChildMenuCloser = document.querySelectorAll('.childchildmenucloser')		
childMenuCloser.forEach((button) => {
	button.addEventListener('click', () => {
		toggleFirstElements.forEach((element) => {
			element.classList.remove('active')
			for (var i = 0; i < elementsg2.length; i++) {
				elementsg2[i].style.display = 'none'
			}
		})
	})
})	
childChildMenuCloser.forEach((button) => {
	button.addEventListener('click', () => {
		toggleSecondElements.forEach((element) => {
			element.classList.remove('active')
			for (var i = 0; i < elementsg3.length; i++) {
				elementsg3[i].style.display = 'none'
			}
			for (var i = 0; i < elementsg2.length; i++) {
				elementsg2[i].style.display = ''
			}
		})
	})
})
	
// Überprüfe die Viewport-Breite mit einem Media Query
var mediaQuery = window.matchMedia('(max-width: 991px)')
// Finde alle Links mit der Klasse "second-dropdown-toggle"
var links = document.querySelectorAll('.second-dropdown-toggle')
		
// Füge einen Event Listener zu jedem Link hinzu
links.forEach(function (link) {
	link.addEventListener('click', function (event) {
	//event.preventDefault(); // Verhindere das Standardverhalten des Links
		
		// Überprüfe, ob der Viewport maximal 991px ist
		if (mediaQuery.matches) {
			// Finde alle Elemente mit der Klasse "grid-3"
			var grid3Elements = document.getElementsByClassName('grid-3')
			
			// Entferne das display: none von der Klasse "grid-3"
			Array.from(grid3Elements).forEach(function (element) {
				element.style.display = ''
			})
			
			// Finde alle Elemente mit der Klasse "grid-2"
			var grid2Elements = document.getElementsByClassName('grid-2')
			
			// Füge das display: none zur Klasse "grid-2" hinzu
			Array.from(grid2Elements).forEach(function (element) {
				element.style.display = 'none'
			})
		}
	})
})
		
// Finde alle <a>-Tags innerhalb von Elementen mit der Klasse "grid-1"
var grid1Links = document.querySelectorAll('.grid-1 a.first-dropdown-toggle')
// Füge einen Event Listener zu jedem <a>-Tag hinzu
grid1Links.forEach(function (link) {
	link.addEventListener('click', function (event) {
		event.preventDefault() // Verhindere das Standardverhalten des Links
		// Finde alle Elemente mit der Klasse "grid-2"
		var grid2Elements = document.getElementsByClassName('grid-2')
		// Iteriere über die gefundenen Elemente und entferne "display: none"
		for (var i = 0; i < grid2Elements.length; i++) {
			grid2Elements[i].style.display = ''
		}
		// Finde alle Elemente mit der Klasse "grid-3"
		var grid3Elements = document.getElementsByClassName('grid-3')
		// Iteriere über die gefundenen Elemente und entferne "display: none"
		for (var j = 0; j < grid3Elements.length; j++) {
			grid3Elements[j].style.display = ''
		}
	})
})
