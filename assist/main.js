var modal_body=document.querySelector("#modal-body");

function addModal(){
    modal_body.innerHTML="";
    duplicateInputs();
    hideButtons("none","none","block","block");
}
function updateModal(This){
    fillModal(This);
    hideButtons("none","block","none","none");
}
function deleteModal(This){
    fillModal(This);
    hideButtons("block","none","none","none");
}



function fillModal(This){
    let parent=This.parentNode.parentNode;
    let lyrics_id=parent.getAttribute("id");
    let title=parent.children[1].textContent;
    let artist=parent.children[2].textContent;
    let song=parent.children[3].children[0].textContent;
    console.log(song);
    let publication_date=parent.children[4].textContent;

    modal_body.innerHTML=`<div>
                            <!-- This Input Allows Storing song id  -->
                            <input type="hidden" name="song_id" value="${lyrics_id}">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="${title}"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Artist</label>
                                <input type="text" class="form-control" name="artist" value="${artist}"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Song</label>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="" style="height: 100px" name="song">value="${song}"</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Publication date</label>
                                <input type="date" class="form-control" name="publication_date" value="${publication_date}"/>
                            </div>
                        </div>`;
}

function duplicateInputs(){
    modal_body.innerHTML+=`<div class="mt-5">
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
}

function hideButtons(x,y,z,v){
    document.getElementById("song-delete-btn").style.display=x;
    document.getElementById("song-update-btn").style.display=y;
    document.getElementById("song-save-btn").style.display=z;
    document.getElementById("duplicate-button").style.display=v;
}


function showLyrics(This){
    document.getElementById("lyrics-modal-body").innerText=This.textContent;  
}






