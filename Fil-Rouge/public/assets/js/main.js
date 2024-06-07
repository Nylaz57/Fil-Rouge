
/////////////////////////////
// CHANGER L'ICONE DU MDP / MASQUER LE MDP
let toggleBtnIcon = document.querySelector(".icon-mdp"); // .icon-container>span>class="icon-mdp"
let inputMdp = document.querySelector("#mdp"); // .icon-container>input>id="mdp"
toggleBtnIcon.addEventListener("click", function (event) {
    event.preventDefault();
    if (inputMdp.type === "password") {
        inputMdp.type = "text";
        toggleBtnIcon.style.backgroundImage = "url('./img/icons/visibility_FILL0_wght400_GRAD0_opsz24.svg')";
    } else if (inputMdp.type === "text") {
        inputMdp.type = "password";
        toggleBtnIcon.style.backgroundImage = "url('./img/icons/visibility_off_FILL0_wght400_GRAD0_opsz24.svg')";
    }
});
//////////////////////////////////////////////////////////


/////////////////////////////
// CONTROLE DU FORMULAIRE DE CONNEXION
const boutonConnexion = document.querySelector('#bouton-connexion');
const errorMessage = document.querySelector('#index-error-message');
boutonConnexion.addEventListener('click', (event) => {


    // errorMessage.style.display = 'block';
    // errorMessage.innerHTML = "mot de passe incorrecte";
    // event.preventDefault();


});
//////////////////////////////////////////////////////////





/////////////////////////////
// VERIFICATION CORRESPONDANCE EMAIL / BDD
const verificationMail = document.querySelector('#email');
verificationMail.addEventListener('blur', () => {
    // verificationMail.style.backgroundColor = 'red';

    fetch("../src/pages/controle_user.php?email=" + verificationMail.value)
        .then(function (response) {
            return response.json();
        })
        .then(function (response) {
            if (response[0].nb !== 1) {
                // this.preventDefault();
                verificationMail.style.backgroundColor = "var(--MSX-medium-red)";
                console.log(response[0].nb);
                // Le mail existe déjà
                errorMessage.style.display = 'block';
                errorMessage.innerHTML = "Adresse ou mot de passe introuvable";
                this.value = "";
                if (verificationMail.addEventListener('focus', function () {
                    errorMessage.innerHTML = "";
                }));
            } else {
                verificationMail.style.backgroundColor = "var(--Sp-green)";
            }
        });

});
//////////////////////////////////////////////////////////