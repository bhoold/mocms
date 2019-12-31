<?php include VIEWPATH.'widget/base_header.php'; ?>
<?php include VIEWPATH.'widget/page_header.php'; ?>
<div id="page-content">
	<div id="main">
		<?php include VIEWPATH.'widget/page_message.php'; ?>

		<?php echo form_open(current_url(), array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>
			<input type="hidden" name="_follow-action">

			<div class="layui-form-item">
				<label class="layui-form-label">字段名</label>
				<div class="layui-input-inline">
					<input name="name" type="text" autocomplete="off" class="layui-input" value="<?php echo $edit_formData['name']; ?>">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">描述</label>
				<div class="layui-input-inline">
					<input name="comment" type="text" autocomplete="off" class="layui-input" value="<?php echo $edit_formData['comment']; ?>">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">类型</label>
				<div class="layui-input-block">
					<input type="radio" name="type" value="TINYINT" title="TINYINT">
    				<input type="radio" name="type" value="SMALLINT" title="SMALLINT">
					<input type="radio" name="type" value="MEDIUMINT" title="MEDIUMINT">
					<input type="radio" name="type" value="INT" title="INT">
					<input type="radio" name="type" value="BIGINT" title="BIGINT">
					<input type="radio" name="type" value="FLOAT" title="FLOAT">
					<input type="radio" name="type" value="DOUBLE" title="DOUBLE">
					<input type="radio" name="type" value="DECIMAL" title="DECIMAL">
					<br />
					<input type="radio" name="type" value="DATE" title="DATE">
					<input type="radio" name="type" value="TIME" title="TIME">
					<input type="radio" name="type" value="YEAR" title="YEAR">
					<input type="radio" name="type" value="DATETIME" title="DATETIME">
					<input type="radio" name="type" value="TIMESTAMP" title="TIMESTAMP">
					<br />
					<input type="radio" name="type" value="CHAR" title="CHAR">
					<input type="radio" name="type" value="VARCHAR" title="VARCHAR">
					<input type="radio" name="type" value="TINYBLOB" title="TINYBLOB">
					<input type="radio" name="type" value="TINYTEXT" title="TINYTEXT">
					<input type="radio" name="type" value="BLOB" title="BLOB">
					<input type="radio" name="type" value="TEXT" title="TEXT">
					<input type="radio" name="type" value="MEDIUMBLOB" title="MEDIUMBLOB">
					<input type="radio" name="type" value="MEDIUMTEXT" title="MEDIUMTEXT">
					<input type="radio" name="type" value="LONGBLOB" title="LONGBLOB">
					<input type="radio" name="type" value="LONGTEXT" title="LONGTEXT">

				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">长度</label>
				<div class="layui-input-inline">
					<input name="length"" type="text" autocomplete="off" class="layui-input" value="<?php echo $edit_formData['length']; ?>">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">默认值</label>
				<div class="layui-input-inline">
					<input name="value" type="text" autocomplete="off" class="layui-input" value="<?php echo $edit_formData['value']; ?>">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">其它</label>
				<div class="layui-input-block">
					<input type="checkbox" name="other[pk]" title="主键" lay-skin="primary">
					<input type="checkbox" name="other[nn]" title="非空" lay-skin="primary">
					<input type="checkbox" name="other[uq]" title="唯一索引" lay-skin="primary">
					<input type="checkbox" name="other[bin]" title="二进制" lay-skin="primary">
					<input type="checkbox" name="other[un]" title="无符号" lay-skin="primary">
					<input type="checkbox" name="other[zf]" title="填充零" lay-skin="primary">
					<input type="checkbox" name="other[ai]" title="自动递增" lay-skin="primary">
				</div>
			</div>

			<div class="layui-form-item layui-hide">
				<div class="layui-input-block">
					<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="*">提交</button>
					<button type="reset" class="layui-btn">重置</button>
				</div>
			</div>

		<?php echo form_close();?>

		</div>
	</div>





<script>
layui.use(['form','layer','alert','util'], function(){
	var $ = layui.jquery,
		form = layui.form, //表单
		layer = layui.layer, //弹层
		util = layui.util;

	form.on('submit(*)', function(data){
		return true;
	});

});
</script>

<?php include VIEWPATH.'widget/base_footer.php'; ?>


