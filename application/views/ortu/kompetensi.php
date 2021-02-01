<div class="col-md-12">
    <table id="myTable" class="table table-bordered">
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Tahun</th>
                <th>Predikat Spiritual</th>
                <th>Sikap Spiritual</th>
                <th>Predikat Sosial</th>
                <th>Sikap Sosial</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i =1;
                foreach($kompetensi as $kmpts):?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $kmpts['nama_kelas'] ?></td>
                    <td><?= $kmpts['semester'] ?></td>
                    <td><?= $kmpts['tahun'] ?></td>
                    <td><?= $kmpts['predikat_spiritual'] ?></td>
                    <td><?= $kmpts['sikap_spiritual'] ?></td>
                    <td><?= $kmpts['predikat_sosial'] ?></td>
                    <td><?= $kmpts['sikap_sosial'] ?></td>
                </tr>
            <?php 
                $i++;
                endforeach;?>
        </tbody>
    </table>
</div>