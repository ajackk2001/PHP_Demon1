

<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">標題</label>
    <div class="col-sm-10">
        <input class="form-control" name="title" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">排序</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" name="sort" value="100" size="10" onKeyPress="Check_num();" onBlur="Cls_event();"/>
    </div>
</div>
<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">是否上架</label>
    <div class="col-sm-10">
    <label><input type="radio" name="is_show" value="0">否</label>&nbsp;&nbsp;
    <label><input type="radio" name="is_show" value="1" checked>是</label>
    </div>
</div>
