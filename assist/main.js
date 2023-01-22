var form=document.forms['add-modal'];

function fillModal(This){
    let parent=This.parentNode.parentNode;
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



function showLyrics(This){
    document.getElementById("lyrics-modal-boday").innerText=This.textContent;  
}



function duplicate(){
    var modal_body=document.querySelector("#modal-body");
    let x=modal_body.innerHTML+=`<div class="mt-5">
                                    <!-- This Input Allows Storing song id  -->
                                    <input type="hidden" name="song_id">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title[]" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Artist</label>
                                        <input type="text" class="form-control" name="artist[]" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Song</label>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="" style="height: 100px" name="song[]"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Publication date</label>
                                        <input type="date" class="form-control" name="publication_date[]" />
                                    </div>
                                </div>`;
    console.log(x);
}


