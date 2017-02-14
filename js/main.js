function displayVideoPdf(divId, youVideo, pdfFile1, pdfFile2) {

	var divElement = document.getElementById(divId); 
	if(divElement.style.display == "none") {

		var pdfFileFullPath = '/home/atish/Desktop/lecture videos/';
		pdfFileFullPath += pdfFile1;
		pdfFileFullPath += pdfFile2;
		var statement = '<div class="home-columns clearfix">' ;
		statement += '<div class="one-half mobile-collapse"> <iframe class="iframe-size" src="http://www.youtube.com/embed/';
		statement += youVideo;
		statement += '" width="400px" height="200px" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
		statement += '<div class="one-half last mobile-collapse"> <iframe class="iframe-size" src="';
		statement += pdfFileFullPath;
		statement += '" width="400px" height="200px" frameborder="0" allowfullscreen=""></iframe> <nav class="site-nav site-header-nav departments-nav clearfix"> <ul> <li><a href="';
		statement += pdfFileFullPath;
		statement += '" download="';
		statement += pdfFile2;
		statement += '" class = "btn-element" >Download</a></li> <li><a href="';
		statement += pdfFileFullPath;
		statement += '" class = "btn-element" >View</a></li> </ul></nav></div></div>';
	
		divElement.innerHTML = statement;
		divElement.style.display = "block"; 
	}
	else {
		divElement.innerHTML = "";
		divElement.style.display = "none"; 
	}

}
