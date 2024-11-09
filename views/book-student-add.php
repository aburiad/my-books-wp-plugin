<div class="card container">
    <div class="alert alert-primary" role="alert">
        Add New Student
    </div>
    <form action="" method="post" id="add-student-form" enctype="multipart/form-data">
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput" class="form-label">Name</label></div>
                <div class="col-10">
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Name"
                    />
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput2" class="form-label">Email</label></div>
                <div class="col-10">
                    <input type="email" class="form-control" name="email" id="formGroupExampleInput2"
                           placeholder="Example email" />
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput" class="form-label">User Name</label></div>
                <div class="col-10">
                    <input type="text" class="form-control" name="username" id="formGroupExampleInput" placeholder="username"
                    />
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput" class="form-label">Password</label></div>
                <div class="col-10">
                    <input type="password" class="form-control" name="password" id="formGroupExampleInput" placeholder="password"
                    />
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-2 text-end"><label for="formGroupExampleInput" class="form-label">Confirm Password</label></div>
                <div class="col-10">
                    <input type="password" class="form-control" name="confirm-password" id="formGroupExampleInput" placeholder="confirm-password"
                    />
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
