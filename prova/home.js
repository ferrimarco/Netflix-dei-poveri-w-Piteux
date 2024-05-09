var categoryChooses = document.querySelectorAll('.categories-link');

for (let i = 0; i < categoryChooses.length; i++) {
	let catChooses = categoryChooses[i]
	catChooses.addEventListener("click", function (e) {
		e.preventDefault()

        var categorySelectedName = catChooses.getAttribute('data-category');
        //console.log(categorySelectedName)

        showCategory(categorySelectedName);
    })
}


function showCategory(category) {
    var categorySelectYet = document.querySelector('.categories-link.category-select')
    categorySelectYet.classList.remove('category-select')

    var categorySelectedElement = document.querySelector(`[data-category="${category}"]`)
    categorySelectedElement.classList.add('category-select')

    // Simuliamo i dati dei film associati alla categoria selezionata
    var moviesData = [
        { title: "Film 1", category: "upcoming", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "upcoming", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "upcoming", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "upcoming", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "upcoming", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "popular", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "popular", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "popular", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "popular", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
        { title: "Film 4", category: "popular", imageUrl: "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTKNvN1d8BSJPWenCvCOx2oOTDYqBSzjLkuDplC6Iw89KZONqnk" },
    ];

    // Filtriamo i film associati alla categoria selezionata
    var categoryMovies = moviesData.filter(function(movie) {
        return movie.category === category;
    });

    var categoryMoviesContainer = document.querySelector('.category-movies');
    categoryMoviesContainer.innerHTML = '';

    categoryMovies.forEach(function(movie, index) {
        setTimeout(function() {
            var movieElement = createMovieElement(movie);

            movieElement.classList.add('animating');

            categoryMoviesContainer.appendChild(movieElement);
        }, index * 500);
    });
}

function createMovieElement(movie) {
    // Creiamo un elemento div per il film
    /*var movieDiv = document.createElement('div');
    movieDiv.classList.add();*/

    // Creiamo un elemento anchor per collegare il film
    var movieLink = document.createElement('a');
    movieLink.href = '#';
    movieLink.classList.add('movie-mini', 'pos-relative');

    // Creiamo un elemento img per l'immagine del film
    var movieImage = document.createElement('img');
    movieImage.src = movie.imageUrl;
    movieImage.alt = movie.title;
    movieImage.classList.add('movie-mini-image');

    // Aggiungiamo l'immagine al collegamento
    movieLink.appendChild(movieImage);

    /*// Aggiungiamo il collegamento al div del film
    movieDiv.appendChild(movieLink);*/

    // Restituiamo l'elemento del film
    return movieLink;
}
