<div class="card container">
    <div class="alert alert-primary" role="alert">
        Add New Author
    </div>
    <form action="" method="post" id="add-new-form" enctype="multipart/form-data">
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput" class="form-label">Name</label></div>
                <div class="col-10">
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Name"
                           required/>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput2" class="form-label">Fb Link</label></div>
                <div class="col-10">
                    <input type="url" class="form-control" name="fb_link" id="formGroupExampleInput2"
                           placeholder="Example Author" required/>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="exampleFormControlTextarea1" class="form-label">About</label>
                </div>
                <div class="col-10">
                    <textarea class="form-control" name="about" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>
        </div>
    </form>
</div>
