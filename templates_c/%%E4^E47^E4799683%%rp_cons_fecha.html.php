<?php /* Smarty version 2.6.26, created on 2018-05-06 22:01:32
         compiled from rp_cons_fecha.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inicio.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="resultados_reporte">
<p>
<div id = "indice">REPORTE DE ARCHIVOS POR FECHA </br>Desde: <?php echo $this->_tpl_vars['fecha_ini']; ?>
 Hasta: <?php echo $this->_tpl_vars['fecha_fin']; ?>
 </div>
</p>
<?php if ($this->_tpl_vars['datos']): ?>
<div id="resultados">
<table class="enhancedtable" cellspacing="0" cellpadding = "3" border="1" align="center" width="100%">
<thead>
	<tr> 
		<th>Id</th>
		<th>Usuario</th>
		<th>Fecha</th>
		<th>Archivo</th>
		<th>Fecha Inicial</th>
		<th>Fecha Final</th>
		<th>Tipo</th>
		<th>Tipo Nomina</th>
		<th>&nbsp;</th>
		
	</tr>
</thead>
<tbody>
	<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['datos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
	<tr>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['usuario']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['fecha']; ?>
</td>
		<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['tipo'] == UPT): ?>
			<td><a href="./upload/nominas_iutet/<?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['nomb_arch']; ?>
"><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['nomb_arch']; ?>
</a></td>
		<?php else: ?>
			<?php if ($this->_tpl_vars['datos'][$this->_sections['p']['index']]['tipo'] == SISTEMA): ?>
				<td><a href="./upload/archivos_figs/<?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['nomb_arch']; ?>
"><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['nomb_arch']; ?>
</a></td>
			<?php else: ?>
				<td><a href="./upload/nominas_caprof/<?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['nomb_arch']; ?>
"><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['nomb_arch']; ?>
</a></td>
			<?php endif; ?>
		<?php endif; ?>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['fecha_ini']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['fecha_fin']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['tipo']; ?>
</td>
		<td><?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['tipo_id']; ?>
</td>
		<td><div id = "boton"><a onclick="return confirm('¿Esta seguro?')" href="?accion=eliminar&amp;id=<?php echo $this->_tpl_vars['datos'][$this->_sections['p']['index']]['id']; ?>
&fecha_ini=<?php echo $this->_tpl_vars['fecha_ini']; ?>
&fecha_fin=<?php echo $this->_tpl_vars['fecha_fin']; ?>
"><img onmouseover='overlib("<strong>Eliminar</strong>",WIDTH, 70)' src="./imagenes/eliminar.png" onmouseout='return nd();'/></a></div></td>
	</tr><?php endfor; endif; ?>
</tbody>
</table>
</div>
<?php else: ?>
	<h3>NO SE ENCONTRÓ NINGUN DATO QUE CORRESPONDA, VERIFIQUE...</h3>
<?php endif; ?>
<?php if ($this->_tpl_vars['datos']): ?>
</div><?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "final.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>