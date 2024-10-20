

$(document).ready(function(){
    var admin_avatar = document.getElementById('avatar-admin');
    var info_admin = document.getElementById('info-admin');
    var close_profile_info = document.getElementById('close-profile-info');

    info_admin.style.display = 'none';
    info_admin.style.visibility = 'hidden';

    admin_avatar.addEventListener('click', function(event) {
        event.stopPropagation();
        info_admin.style.display = 'flex';
        info_admin.style.visibility = 'visible';
        info_admin.style.opacity = 1;
    });

    close_profile_info.addEventListener('click', function() {
        info_admin.style.display = 'none';
        info_admin.style.visibility = 'hidden';
    });
})
