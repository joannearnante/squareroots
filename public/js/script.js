function activeinventorycard(){
		document.querySelector("#activeinventorycard").setAttribute("style", "display: block;");
		document.querySelector("#categoriescard").setAttribute("style", "display: none;");
		document.querySelector("#inventoryhistorycard").setAttribute("style", "display: none;");
	};

function categoriescard(){
		document.querySelector("#activeinventorycard").setAttribute("style", "display: none;");
		document.querySelector("#categoriescard").setAttribute("style", "display: block;");
		document.querySelector("#inventoryhistorycard").setAttribute("style", "display: none;");
	};

function inventoryhistorycard(){
		document.querySelector("#activeinventorycard").setAttribute("style", "display: none;");
		document.querySelector("#categoriescard").setAttribute("style", "display: none;");
		document.querySelector("#inventoryhistorycard").setAttribute("style", "display: block;");
	};