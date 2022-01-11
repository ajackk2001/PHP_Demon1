

<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">標題</label>
    <div class="col-sm-10">
    <?=$info['title']?>
  </div>
</div>

<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">內容</label>
    <div class="col-sm-10">
    <?php echo htmlEdit('content', $info['content'])?>
  </div>
</div>