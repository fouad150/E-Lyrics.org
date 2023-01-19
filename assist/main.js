var form=document.forms['add-modal'];

function showModal(button){
    let parent=button.parentNode.parentNode;
    let lyrics_id=parent.getAttribute("id");
    let title=parent.children[1].textContent;
    let artist=parent.children[2].textContent;
    let song=parent.children[3].children[0].textContent;
    let publication_date=parent.children[4].textContent;

    form.song_id.value=lyrics_id;
    form.title.value=title;
    form.artist.value=artist;
    form.song.value=song;
    form.publication_date.value=publication_date;
    // hideSave();
}

// function emtyModal(){
//     form.reset();
//     hideUpdateAndDelete();
// }

// function hideSave(){
//     document.getElementById("instrument-save-btn").style.display="none";
//     document.getElementById("instrument-update-btn").style.display="block";
//     document.getElementById("instrument-delete-btn").style.display="block";
// }

// function hideUpdateAndDelete(){
//     document.getElementById("instrument-delete-btn").style.display="none";
//     document.getElementById("instrument-update-btn").style.display="none";
//     document.getElementById("instrument-save-btn").style.display="block";
// }