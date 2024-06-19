function toggleSortList() {
    var list = document.getElementById("sort_list");
    var icon = document.getElementById("toggleSortIcon");
    if (list.style.display === "none" || list.style.display === "") {
        list.style.display = "block";
        icon.textContent = "arrow_drop_up";
    } else {
        list.style.display = "none";
        icon.textContent = "arrow_drop_down";
    }
}

function toggleAccountList() {
    var list = document.getElementById("account_list");
    var icon = document.getElementById("toggleAccountIcon");
    if (list.style.display === "none" || list.style.display === "") {
        list.style.display = "block";
        icon.textContent = "arrow_drop_up";
    } else {
        list.style.display = "none";
        icon.textContent = "arrow_drop_down";
    }
}

function fixedPosition(){
    document.addEventListener('DOMContentLoaded', function () {
        const jobPage = document.getElementById('job_offer_page');
    
        window.addEventListener('scroll', function () {
            const scrollPosition = window.scrollY; 
            console.log(scrollPosition);
            if (scrollPosition > 200) { 
                jobPage.style.position = 'fixed';
                jobPage.style.bottom =  '11.8vw';
                jobPage.style.right = '6.2vw';
            } else {
                jobPage.style.position = 'static'
                jobPage.style.margin = '2vw 0vw 2vw 7vw';
            }
        });
    });
}

function editMainInfo(){
    isEditing = true;
    var name = document.getElementById('name');
    var status = document.getElementById('work');
    var birthDate = document.getElementById('birthDate');
    var avatarOverlay = document.getElementById('profileAvatarOverlay');
    document.getElementById('editMainInfoId').style.display = "none";
    document.getElementById('saveMainChanges').style.display = "block";


    avatarOverlay.style.display="flex";

    name.classList.remove('input');
    name.classList.add('inputEditable');
    name.removeAttribute('disabled');

    status.classList.remove('input');
    status.classList.add('inputEditable');
    status.removeAttribute('disabled');

    birthDate.classList.remove('input');
    birthDate.classList.add('inputEditable');
    birthDate.removeAttribute('disabled');

}

function editContactInfo(){
    isEditing = true;
    var mail = document.getElementById('mail');
    var phone = document.getElementById('phoneNumber');
    document.getElementById('editContactInfoId').style.display = "none";
    document.getElementById('saveContactChanges').style.display = "block";

    mail.classList.remove('input');
    mail.classList.add('inputEditable');
    mail.removeAttribute('disabled');

    phone.classList.remove('input');
    phone.classList.add('inputEditable');
    phone.removeAttribute('disabled');
}

function editDescriptionInfo(){
    isEditing = true;
    var description = document.getElementById('aboutMe');
    document.getElementById('editDescriptionInfoId').style.display = "none";
    document.getElementById('saveDescriptionChanges').style.display = "block";

    
    description.classList.remove('input');
    description.classList.add('inputEditable');
    description.removeAttribute('disabled');
}
function toggleChangePasswordVisibility() {
    const button = document.getElementById('changePasswordShow');
    const form = document.getElementById('changePasswordForm');
    const changePasswordDiv = document.getElementById('changePassword');
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        button.innerHTML = "Collapse";
        changePasswordDiv.style.borderBottom = "none";
        form.style.borderBottom = "0.1px solid #A9A9A9";
    } else {
        form.classList.add('hidden');
        button.innerHTML = "Change";
        changePasswordDiv.style.borderBottom = "0.1px solid #A9A9A9";
        form.style.borderBottom = "none";
    }
}

function toggleDeleteAccountVisibility() {
    const button = document.getElementById('deleteAccountShow');
    const form = document.getElementById('deleteAccountForm');
    const deleteAccountDiv = document.getElementById('deleteAccount');
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        button.innerHTML = "Collapse";
        deleteAccountDiv.style.borderBottom = "none";
        form.style.borderBottom = "0.1px solid #A9A9A9";
    } else {
        form.classList.add('hidden');
        button.innerHTML = "Delete";
        deleteAccountDiv.style.borderBottom = "0.1px solid #A9A9A9";
        form.style.borderBottom = "none";
    }
}

var isEditing = false;
const mainInfoOver = document.getElementById('main_info');
const mainInfoButton = document.getElementById('editMainInfoId');
const contactInfoOver = document.getElementById('contact');
const contactInfoButton = document.getElementById('editContactInfoId');
const descriptionInfoOver = document.getElementById('description');
const descriptionButton = document.getElementById('editDescriptionInfoId');

mainInfoOver.addEventListener('mouseover', () => {
    if (!isEditing) {
    mainInfoButton.style.display = "block";
    }
});

mainInfoOver.addEventListener('mouseout', () => {
    if (!isEditing) {
    mainInfoButton.style.display = "none";
    }
});

contactInfoOver.addEventListener('mouseover', () => {
    if (!isEditing) {
    contactInfoButton.style.display = "block";
    }
});


contactInfoOver.addEventListener('mouseout', () => {
    if (!isEditing) {
    contactInfoButton.style.display = "none";  
    }
});

descriptionInfoOver.addEventListener('mouseover', () => {
    if (!isEditing) {
    descriptionButton.style.display = "block";
    }
});

descriptionInfoOver.addEventListener('mouseout', () => {
    if (!isEditing) {
        descriptionButton.style.display = "none";
    }
});

function toggleApplicationInfo(job_id) {
    var infoDiv = document.getElementById("applicationInfo_" + job_id);
    var icon = document.getElementById("toggleIcon_" + job_id);
    if (infoDiv.style.display === "none" || infoDiv.style.display === "") {
        infoDiv.style.display = "block";
        icon.textContent = "arrow_drop_up";
        
        function changeStatusBackground(applicationId){
        var status = document.getElementById("statusText_" + applicationId);
        if (status.textContent.trim() === "Pending") {
            status.style.backgroundColor = "#ffcc99";
        }else if(status.textContent.trim() === "Accepted"){
            status.style.backgroundColor = "#93dfb2";
        }else if(status.textContent.trim() === "Declined"){
            status.style.backgroundColor = "#ef010946";
        }
    }
    } else {
        infoDiv.style.display = "none";
        icon.textContent = "arrow_drop_down";
    }
}

function toggleDeleteOverlay(job_id) {
    var questionBox = document.getElementById('deleteOfferBox_' + job_id);
    var jobOffersScroll = document.getElementById('job_offers');
    if (questionBox.style.display === "none" || questionBox.style.display === "") {
        questionBox.style.display = "block";
        jobOffersScroll.style.overflow = "clip";
    } else {
        questionBox.style.display = "none";
        jobOffersScroll.style.overflow = "auto";
    }
}

function previewAndUploadImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Wyświetl podgląd obrazu
            document.getElementById('myPhoto').src = e.target.result;

            // Utwórz formularz danych do wysłania
            const formData = new FormData(document.getElementById('avatarForm'));

            // Wyślij obraz na serwer
            fetch('uploadAvatar.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log('Success:', result);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        };
        reader.readAsDataURL(file);
    }
}