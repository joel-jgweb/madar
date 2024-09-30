// Récupérer les mots clés depuis le serveur et les insérer dans la liste déroulante
fetch('get_keywords.php')
    .then(response => response.json())
    .then(keywords => {
        const keywordsSelect = document.getElementById('keywords');
        keywords.forEach(keyword => {
            const option = document.createElement('option');
            option.value = keyword;
            option.text = keyword;
            keywordsSelect.add(option);
        });
    })
    .catch(error => console.error('Erreur lors du chargement des mots-clés:', error));

// Gestion de la soumission du formulaire
document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Empêcher le rechargement de la page
    
    // Récupérer la valeur du mot-clé sélectionné
    const keyword = document.getElementById('keywords').value;
    
    // Effectuer la requête de recherche avec le mot-clé
    fetch(`search_articles.php?keywords=${keyword}`)
        .then(response => response.json())
        .then(articles => {
            const resultDiv = document.getElementById('resultats');
            resultDiv.innerHTML = ''; // Vider les résultats précédents
            
            // Vérifier si des articles sont retournés
            if (articles.length === 0) {
                resultDiv.innerHTML = '<p>Aucun article trouvé.</p>';
            } else {
                // Pour chaque article, créer une entrée à afficher
                articles.forEach(article => {
                    const articleDiv = document.createElement('div');
                    articleDiv.innerHTML = `
                        <h3>${article.Titre}</h3>
                        <p>${article.Contenu}</p>`;
                    resultDiv.appendChild(articleDiv);
                });
            }
        })
        .catch(error => console.error('Erreur lors de la recherche d\'articles:', error));
});
