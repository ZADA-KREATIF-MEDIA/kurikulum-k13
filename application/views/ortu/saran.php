<h3>SARAN WALI KELAS</h3>
<hr>
<div class="col-md-12">
    <table id="myTable" class="table table-bordered">
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Tahun</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i =1;
                foreach($saran as $srn):?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $srn['nama_kelas'] ?></td>
                    <td><?= $srn['semester'] ?></td>
                    <td><?= $srn['tahun'] ?></td>
                    <td><?= $srn['catatanwk'] ?></td>
                </tr>
            <?php 
                $i++;
                endforeach;?>
        </tbody>
    </table>
</div>