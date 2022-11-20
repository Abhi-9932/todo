
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.1/sweetalert2.min.js" integrity="sha512-TZHwBGULaChdwt6/Y+eYLQZGLvuNdJV6ZlszDZAzczToJgjJtB/JEjxrethtTZMmvIuCGmzTgFXcOjNIP0zogg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.1/sweetalert2.css" integrity="sha512-0BcnfLcXBm81KVM/wzoS7yZRVflcQC3rj/Wqgi4cHSGktXTMcXrP6kquf1I14JFUj2LiFCfpZCSf/+478ifefA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="container">
        <h6>Dashboard </h6>
        <p>Welcome, <?= $this->session->userdata('userdata')[0]->name?></p>
        <a href="<?= base_url('logout')?>"><button class="btn btn-warning">Logout</button></a>
        <?php if($this->session->flashdata('id_blank')): ?>
            <script>toastr.error('<?= $this->session->flashdata('id_blank')?>')</script>
        <?php endif;?>
        <?php if($this->session->flashdata('delete_success')): ?>
            <script>toastr.error('<?= $this->session->flashdata('delete_success')?>')</script>
        <?php endif;?>
        <?php if($this->session->flashdata('delete_error')): ?>
            <script>toastr.error('<?= $this->session->flashdata('delete_error')?>')</script>
        <?php endif;?>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Sl NO#</th>
                    <th>Email ID</th>
                    <th>Full Name</th>
                    <th>Date Of Birth</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $key => $u):?>
                    <tr>
                        <td><?= $key+1 ?></td>
                        <td><?= $u->email ?></td>
                        <td><?= $u->name ?></td>
                        <td><?= $u->dob ?></td>
                        <td><?= $u->created_at ?></td>
                        <td><?= $u->status ?></td>
                        <td>
                            <a href="<?= base_url('user-edit/'.base64_encode($u->id))?>"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0);" onclick="deleteme('<?= base64_encode($u->id)?>')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
	</div>
	<script>
        function deleteme(userid){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = '<?= base_url('user-delete')?>' + '/' + userid;
                    $.get(url, function(res){
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    });                    
                }
            })
            
        }
	</script>
</body>
</html>