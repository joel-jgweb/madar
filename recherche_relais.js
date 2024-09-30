document.addEventListener('DOMContentLoaded', function() {
    // Remplir la liste des années
    fetch('get_years.php')
        .then(response => response.json())
        .then(data => {
            const anneeSelect = document.getElementById('annee');
            data.forEach(year => {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                anneeSelect.appendChild(option);
            });
        });

    // Remplir la liste des auteurs
    fetch('get_authors.php')
        .then(response => response.json())
        .then(data => {
            const auteursList = document.getElementById('auteursList');
            data.forEach(author => {
                const option = document.createElement('option');
                option.value = author;
                auteursList.appendChild(option);
            });
        });
});

function searchArticles() {
    const auteurs = document.getElementById('auteurs').value;
    const annee = document.getElementById('annee').value;
    const libelle = document.getElementById('libelle').value;
    const motsCles = document.getElementById('motsCles').value;

    const params = new URLSearchParams({
        auteurs: auteurs,
        annee: annee,
        libelle: libelle,
        motsCles: motsCles
    });

    fetch('search_articles.php?' + params.toString())
        .then(response => response.json())
        .then(data => {
            displayResults(data);
        });
}

function displayResults(rows) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    if (rows.length === 0) {
        resultsDiv.innerHTML = '<p>Aucun résultat trouvé.</p>';
        return;
    }

    const table = document.createElement('table');
    const thead = document.createElement('thead');
    const tbody = document.createElement('tbody');

    const headers = ['Libellé', 'Auteurs', 'Trimestre', 'Année', 'Numéros', 'Fichier'];
    const tr = document.createElement('tr');
    headers.forEach(header => {
        const th = document.createElement('th');
        th.textContent = header;
        tr.appendChild(th);
    });
    thead.appendChild(tr);
    table.appendChild(thead);

    rows.forEach(row => {
        const tr = document.createElement('tr');
        const libelleTd = document.createElement('td');
        libelleTd.textContent = row.Libellé;
        tr.appendChild(libelleTd);

        const auteursTd = document.createElement('td');
        auteursTd.textContent = row.Auteurs;
        tr.appendChild(auteursTd);

        const trimestreTd = document.createElement('td');
        trimestreTd.textContent = row.Trimestre;
        tr.appendChild(trimestreTd);

        const anneeTd = document.createElement('td');
        anneeTd.textContent = row.annee;
        tr.appendChild(anneeTd);

        const numerosTd = document.createElement('td');
        numerosTd.textContent = row.Numeros;
        tr.appendChild(numerosTd);

        const fichierTd = document.createElement('td');
        const fichierLink = document.createElement('a');
        fichierLink.href = row.adresse;
        fichierLink.textContent = row.fichiers;
        fichierTd.appendChild(fichierLink);
        tr.appendChild(fichierTd);

        tbody.appendChild(tr);
    });

    table.appendChild(tbody);
    resultsDiv.appendChild(table);
}