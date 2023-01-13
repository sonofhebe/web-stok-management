<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jadwal</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Jadwal</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Jadwal Produk</h2>
        </div>
    </section>
    <div class="col-md-3">
    <form action="<?= base_url('inputsession-jadwal') ?>" method="post">
        <div class="form-group">
            <label for="">Pilih Hari</label>
            <select onchange="this.form.submit();" name="hari" id="" class="form-control">
                <option value="" selected disabled>-- PILIH HARI --</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jum'at">Jum'at</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>
    </form>
    </div>
    </div>
</div>