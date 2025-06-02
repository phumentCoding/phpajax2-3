const fetchData = () => {
    try{
        
        $.ajax({
            type: "GET",
            url: "controller.php",
            dataType: "json",
            success: function (response) {
                // console.log(response);

                let students =  response.data.students;

                console.log(students);

                let tr = ``;
                $.map(students, function (value, index) {
                    tr += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${value.id}</td>
                            <td>image.jpg</td>
                            <td>${value.name}</td>
                            <td>${value.gender}</td>
                            <td>${value.phone}</td>
                            <td>${value.email}</td>
                            <td>${value.address}</td>
                            <td>
                                <button onclick="editStudent(${value.id})" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStudentModal">Edit</button>
                                <button onclick="deleteStudent(${value.id})" class=" btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    `;
                });

                $("#studentTableBody").html(tr);
            }
        });

    }catch(e){
        console.log(e);
    }
}

fetchData();


const addStudent = () => {
    try {
        let data = new FormData($("#addStudentForm")[0]);

        let student = {
            name : data.get('name'),
            gender : data.get('gender'),
            email  : data.get('email'),
            phone  : data.get('phone'),
            address : data.get('address')
        }

       console.log(student)


       $.ajax({
        type: "POST",
        url: "controller.php",
        data: student,
        dataType: "json",
        success: function (response) {
            fetchData();
            $("#addStudentModal").modal('hide');
        }
       });


    }catch(e){
        console.log(e);
    }
}

const deleteStudent = (id) => {
    try{
        if(confirm('Do you to delete this?')){
            $.ajax({
                type: "DELETE",
                url: "controller.php?id="+id,
                dataType: "json",
                success: function (response) {
                    fetchData();
                }
            });
        }

    }catch(e){

    }
}


const editStudent = (id) => {
    try{
    //    alert(id)
       $.ajax({
        type: "GET",
        url: "controller.php?id="+id,
        success: function (response) {
            let student = response.data.student;

            $("#show-student-edit").html(`
                <form id="updateStudentForm" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="id" value="${student.id}"/>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="${student.name}" class="form-control" id="name" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked />
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" />
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" value="${student.phone}" name="phone" id="phone" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="${student.email}" id="email" required />
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3">${student.address}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Student Image</label>
                        <input type="file" class="form-control" id="editImage" name="image" accept="image/*" />
                        <div class="image-preview-container mt-2">
                            <div class="image-preview" id="editImagePreview">
                                <div class="preview-placeholder">Image preview will appear here</div>
                            </div>
                            <div class="remove-image-btn" id="editRemoveImageBtn">
                                <i class="bi bi-x"></i>
                            </div>
                        </div>
                    </div>
                </form>
            `);
        }
       });
    }catch(e){
       console.log(e)
    }
}


const updateStudent = () => {
    try{

        let data  = new FormData($("#updateStudentForm")[0]);

        let id = data.get('id');
        let student = {
            name : data.get('name'),
            gender :  data.get('gender'),
            email  : data.get('email'),
            phone : data.get('phone'),
            address : data.get('address')
        }

        $.ajax({
            type: "POST",
            url: "controller.php?id="+id,
            data: student,
            dataType: "json",
            success: function (response) {
                
            }
        });
    }catch(e){
        alert(e);
    }
}