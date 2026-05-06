<div class="card shadow mb-4">
    <div class="card-body">
        <form class="form-inline" method="GET" action="">
            <div class="form-group mb-2 mr-2 flex-grow-1">
                <label for="phoneSearch" class="sr-only">Số điện thoại</label>
                <input type="text" class="form-control w-100" id="phoneSearch" name="phone" placeholder="Nhập số điện thoại người dùng" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">
                <i class="fas fa-search mr-1"></i>Tìm kiếm
            </button>
        </form>
    </div>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($message); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>