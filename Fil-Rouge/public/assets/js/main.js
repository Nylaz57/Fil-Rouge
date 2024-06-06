
/////////////////////////////
// CHANGER L'ICONE DU MDP / MASQUER LE MDP
let toggleBtnIcon = document.querySelector(".icon-mdp"); // .icon-container>span>class="icon-mdp"
let inputMdp = document.querySelector("#mdp"); // .icon-container>input>id="mdp"

toggleBtnIcon.addEventListener("click", function (event) {
    event.preventDefault();
    if (inputMdp.type === "password") {
        inputMdp.type = "text";
        toggleBtnIcon.style.backgroundImage = "url('../../img/icons/visibility_FILL0_wght400_GRAD0_opsz24.svg')";
    } else if (inputMdp.type === "text") {
        inputMdp.type = "password";
        toggleBtnIcon.style.backgroundImage = "url('../../img/icons/visibility_off_FILL0_wght400_GRAD0_opsz24.svg')";
    }
});
//////////////////////////////////////////////////////////