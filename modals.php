<!-- Modal Add Task -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Tambah Task Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Task -->
                <form id="addTaskForm" action="add_task.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="job_name" class="form-label">Nama Pekerjaan</label>
                        <input type="text" class="form-control" id="job_name" name="job_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="staff_name" class="form-label">Nama Petugas</label>
                        <input type="text" class="form-control" id="staff_name" name="staff_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="job_date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="job_date" name="job_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="job_time" class="form-label">Jam</label>
                        <input type="time" class="form-control" id="job_time" name="job_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto_before" class="form-label">Foto Before</label>
                        <input type="file" class="form-control" id="foto_before" name="foto_before" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto_after" class="form-label">Foto After</label>
                        <input type="file" class="form-control" id="foto_after" name="foto_after" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Task -->
<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Edit Task -->
                <form id="editTaskForm" action="edit_task.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="editJobName" class="form-label">Nama Pekerjaan</label>
                        <input type="text" class="form-control" id="editJobName" name="job_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStaffName" class="form-label">Nama Petugas</label>
                        <input type="text" class="form-control" id="editStaffName" name="staff_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editJobDate" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="editJobDate" name="job_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="editJobTime" class="form-label">Jam</label>
                        <input type="time" class="form-control" id="editJobTime" name="job_time" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete Task -->
<div class="modal fade" id="deleteTaskModal" tabindex="-1" role="dialog" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTaskModalLabel">Hapus Task Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus task ini?</p>
                <!-- Form Delete Task -->
                <form id="deleteTaskForm" action="delete_task.php" method="post">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

