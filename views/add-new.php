<div class="card container">
    <div class="alert alert-primary" role="alert">
        Add New
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
                <div class="col-2 text-end"><label for="formGroupExampleInput2" class="form-label">Author</label></div>
                <div class="col-10">
                    <input type="text" class="form-control" name="author" id="formGroupExampleInput2"
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
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formFileSm" class="form-label">Upload Image</label></div>
                <div class="col-10">
                    <input class="form-control form-control-md" value="Upload Image" id="btnimage" type="button" />
                    <span id="show_image"></span>
                    <input type="hidden" id="book_image" name="book_image" />
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
