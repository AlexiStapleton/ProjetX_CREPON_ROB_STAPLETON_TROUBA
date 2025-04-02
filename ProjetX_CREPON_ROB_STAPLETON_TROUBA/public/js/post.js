document.querySelectorAll(".li_rt").forEach(li => {
    li.addEventListener("click", (event) => {
        const div = li.querySelector(".div_rt");
        if (div && div.classList.contains("div_rt")) {
            div.style.display = "flex";
            event.stopPropagation();
        }
    });
});

document.addEventListener("click", (event) => {
    document.querySelectorAll(".div_rt").forEach(div => {
        if (!div.contains(event.target)) {
            div.style.display = "none";
        }
    });
});

document.querySelectorAll(".quote").forEach(div => {
    div.addEventListener("click", (event) => {
        const bk = document.querySelector("#background_popup");
        if (bk) {
            bk.style.display = "flex";
            event.stopPropagation();
        }
    });
});

document.addEventListener("click", (event) => {
    const popup = document.querySelector("#background_popup");
    if (popup && !popup.contains(event.target)) {
        popup.style.display = "none";
    }
});

document.querySelectorAll("#background_popup").forEach(div => {
    div.addEventListener("click", (event) => {
        if (event.target === div) {
            div.style.display = "none";
        }
    });
});


window.csrfToken = "{{ csrf_token() }}";
// Version sécurisée avec vérifications
document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.but_like');

    if (likeButtons.length === 0) {
        console.warn('Aucun bouton avec la classe "but_like" trouvé');
        return;
    }

    likeButtons.forEach(button => {
        if (button.hasAttribute('data-listener-attached')) {
            return;
        }

        button.setAttribute('data-listener-attached', 'true');

        button.addEventListener('click', async function(e) {
            e.preventDefault();
            e.stopPropagation();

            try {
                // 1. Désactiver le bouton pendant la requête
                button.disabled = true;

                const postId = button.dataset.postId;
                const userId = button.dataset.userId;

                // 2. Vérification des données requises
                if (!postId || !userId) {
                    throw new Error('ID manquant');
                }

                // 3. Requête AJAX sécurisée
                const response = await fetch('/like/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        post_id: postId,
                        user_id: userId
                    })
                });

                // 4. Vérification de la réponse
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(errorData.message || 'Erreur serveur');
                }

                const data = await response.json();

                // 5. Mise à jour de l'interface
                if (data.success) {
                    // Solution robuste pour la mise à jour du compteur
                    const baseEmoji = '👍'; // Ou extraire du texte existant
                    button.textContent = `${baseEmoji} ${data.likes_count}`;
                    button.classList.toggle('liked', data.liked);
                }

            } catch(error) {
                console.error('Erreur:', error);
                // Option: Afficher un message temporaire
                const originalText = button.textContent;
                button.textContent = 'Erreur';
                setTimeout(() => { button.textContent = originalText; }, 2000);
            } finally {
                // 6. Réactiver le bouton dans tous les cas
                button.disabled = false;
            }
        });
    });
});
