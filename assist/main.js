var form=document.forms['add-modal'];

function fillModal(button){
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
}

function saveModal(){
    form.reset();//reset() is a function that empty the Modal
    hideButtons("none","none","block");
}

function updateModal(button){
    fillModal(button);
    hideButtons("none","block","none");
}

function deleteModal(button){
    fillModal(button);
    hideButtons("block","none","none");
}

function hideButtons(x,y,z){
    document.getElementById("song-delete-btn").style.display=x;
    document.getElementById("song-update-btn").style.display=y;
    document.getElementById("song-save-btn").style.display=z;
}