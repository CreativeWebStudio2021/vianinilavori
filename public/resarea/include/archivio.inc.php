<?php
/**
 * Gestione Archivio documentale (filesystem, senza database).
 * Repository: public/resarea/archivio/
 */
?>
<style>
#archivio-app { font-family: 'PT Sans', Arial, sans-serif; }
#archivio-app .arch-toolbar {
	display: flex; flex-wrap: wrap; gap: 8px; align-items: center;
	margin-bottom: 16px; padding: 12px; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px;
}
#archivio-app .arch-toolbar .btn {
	display: inline-flex; align-items: center; gap: 6px;
	padding: 8px 14px; border: none; border-radius: 3px; cursor: pointer;
	font-size: 13px; color: #fff; text-decoration: none; line-height: 1.2;
}
#archivio-app .btn-primary { background: #438aab; }
#archivio-app .btn-primary:hover { background: #367089; }
#archivio-app .btn-success { background: #5a9e3a; }
#archivio-app .btn-success:hover { background: #4a8530; }
#archivio-app .btn-danger { background: #c0392b; }
#archivio-app .btn-danger:hover { background: #a93226; }
#archivio-app .btn-warn { background: #d68910; }
#archivio-app .btn-warn:hover { background: #b9770e; }
#archivio-app .btn-muted { background: #7f8c8d; }
#archivio-app .btn-muted:hover { background: #6c7a7b; }
#archivio-app .btn:disabled { opacity: .45; cursor: not-allowed; }
#archivio-app .arch-crumbs {
	margin-bottom: 12px; font-size: 14px; color: #555;
}
#archivio-app .arch-crumbs a { color: #438aab; text-decoration: none; }
#archivio-app .arch-crumbs a:hover { text-decoration: underline; }
#archivio-app .arch-crumbs .sep { margin: 0 6px; color: #aaa; }
#archivio-app .arch-table {
	width: 100%; border-collapse: collapse; background: #fff;
	border: 1px solid #ddd;
}
#archivio-app .arch-table th {
	background: #35353a; color: #fff; text-align: left; padding: 10px 12px; font-size: 13px;
}
#archivio-app .arch-table td {
	padding: 10px 12px; border-bottom: 1px solid #eee; font-size: 14px; vertical-align: middle;
}
#archivio-app .arch-table tr:hover td { background: #f9fbfd; }
#archivio-app .arch-table .name-cell { display: flex; align-items: center; gap: 10px; }
#archivio-app .arch-table .name-cell a { color: #222; text-decoration: none; font-weight: 600; }
#archivio-app .arch-table .name-cell a:hover { color: #438aab; }
#archivio-app .arch-table .icon {
	width: 28px; text-align: center; font-size: 18px; color: #438aab;
}
#archivio-app .arch-table .icon.folder { color: #e67e22; }
#archivio-app .arch-actions { white-space: nowrap; }
#archivio-app .arch-actions button, #archivio-app .arch-actions a {
	display: inline-flex; align-items: center; justify-content: center;
	width: 32px; height: 32px; margin: 0 2px; border: 1px solid #ddd;
	background: #fff; border-radius: 3px; cursor: pointer; color: #444; text-decoration: none;
}
#archivio-app .arch-actions button:hover, #archivio-app .arch-actions a:hover {
	background: #438aab; color: #fff; border-color: #438aab;
}
#archivio-app .arch-actions .del:hover { background: #c0392b; border-color: #c0392b; }
#archivio-app .arch-empty {
	padding: 40px; text-align: center; color: #888; border: 1px dashed #ccc; background: #fafafa;
}
#archivio-app .arch-link-row {
	display: flex; gap: 6px; align-items: center; max-width: 420px;
}
#archivio-app .arch-link-row input {
	flex: 1; font-size: 12px; padding: 4px 8px; border: 1px solid #ccc; border-radius: 3px;
	background: #f8f8f8; color: #333;
}
#archivio-app .arch-link-row button {
	padding: 4px 10px; font-size: 12px; border: 1px solid #438aab; background: #438aab;
	color: #fff; border-radius: 3px; cursor: pointer; white-space: nowrap;
}
#archivio-app .arch-link-row button.copied { background: #5a9e3a; border-color: #5a9e3a; }
#archivio-app .upload-progress-wrap {
	display: none; margin: 12px 0; padding: 12px; background: #eef6fa; border: 1px solid #b8d4e3; border-radius: 4px;
}
#archivio-app .upload-progress-bar {
	height: 14px; background: #d0dce3; border-radius: 7px; overflow: hidden;
}
#archivio-app .upload-progress-bar > span {
	display: block; height: 100%; width: 0; background: #438aab; transition: width .15s ease;
}
#archivio-app .upload-progress-label { margin-top: 6px; font-size: 13px; color: #333; }
#archivio-app .arch-msg {
	display: none; margin-bottom: 12px; padding: 10px 14px; border-radius: 3px; font-size: 14px;
}
#archivio-app .arch-msg.ok { display: block; background: #e8f6e8; color: #1e7a1e; border: 1px solid #b7dfb7; }
#archivio-app .arch-msg.err { display: block; background: #fdecea; color: #c0392b; border: 1px solid #f5c6cb; }
#archivio-app .arch-msg.info { display: block; background: #eef6fa; color: #2c6b8a; border: 1px solid #b8d4e3; }

/* Modal generico */
.arch-modal-backdrop {
	display: none; position: fixed; inset: 0; background: rgba(0,0,0,.55); z-index: 20000;
	align-items: center; justify-content: center; padding: 20px;
}
.arch-modal-backdrop.open { display: flex; }
.arch-modal {
	background: #fff; border-radius: 6px; max-width: 520px; width: 100%;
	box-shadow: 0 10px 40px rgba(0,0,0,.3); overflow: hidden;
}
.arch-modal.wide { max-width: 960px; height: 85vh; display: flex; flex-direction: column; }
.arch-modal-header {
	display: flex; justify-content: space-between; align-items: center;
	padding: 14px 18px; background: #35353a; color: #fff;
}
.arch-modal-header h3 { margin: 0; font-size: 16px; font-weight: 600; }
.arch-modal-header .close {
	background: none; border: none; color: #fff; font-size: 22px; cursor: pointer; line-height: 1;
}
.arch-modal-body { padding: 18px; overflow: auto; flex: 1; }
.arch-modal-footer {
	padding: 12px 18px; border-top: 1px solid #eee; display: flex; gap: 8px; justify-content: flex-end;
}
.arch-modal-body label { display: block; margin-bottom: 6px; font-weight: 600; font-size: 13px; }
.arch-modal-body input[type=text] {
	width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;
}
.arch-modal-body .tree-list { max-height: 320px; overflow: auto; border: 1px solid #ddd; border-radius: 3px; }
.arch-modal-body .tree-item {
	padding: 8px 12px; cursor: pointer; border-bottom: 1px solid #f0f0f0; font-size: 14px;
}
.arch-modal-body .tree-item:hover { background: #f5f9fb; }
.arch-modal-body .tree-item.selected { background: #dff0f8; font-weight: 600; }
.arch-modal-body .tree-item .pad { display: inline-block; }
.arch-preview-frame { width: 100%; height: calc(85vh - 120px); border: none; background: #f0f0f0; }
.arch-preview-img { max-width: 100%; max-height: calc(85vh - 140px); display: block; margin: 0 auto; }
</style>

<div id="archivio-app" class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span><i class="icon-folder-open"></i> Archivio documentale</span>
	</div>
	<div class="mws-panel-body" style="padding:16px;">
		<div id="arch-msg" class="arch-msg"></div>

		<div class="arch-toolbar">
			<button type="button" class="btn btn-primary" id="arch-btn-mkdir"><i class="fa fa-folder-plus"></i> Nuova cartella</button>
			<label class="btn btn-success" style="margin:0; cursor:pointer;">
				<i class="fa fa-upload"></i> Carica file
				<input type="file" id="arch-file-input" multiple style="display:none;">
			</label>
			<button type="button" class="btn btn-warn" id="arch-btn-move" disabled><i class="fa fa-arrows-alt"></i> Sposta selezionati</button>
			<button type="button" class="btn btn-danger" id="arch-btn-delete-many" disabled><i class="fa fa-trash"></i> Elimina selezionati</button>
			<button type="button" class="btn btn-muted" id="arch-btn-refresh"><i class="fa fa-sync"></i> Aggiorna</button>
		</div>

		<div class="upload-progress-wrap" id="arch-upload-progress">
			<div class="upload-progress-bar"><span id="arch-upload-bar"></span></div>
			<div class="upload-progress-label" id="arch-upload-label">Caricamento…</div>
		</div>

		<div class="arch-crumbs" id="arch-crumbs"></div>
		<div id="arch-listing"></div>
	</div>
</div>

<!-- Modal nuova cartella -->
<div class="arch-modal-backdrop" id="arch-modal-mkdir">
	<div class="arch-modal">
		<div class="arch-modal-header">
			<h3>Nuova cartella</h3>
			<button type="button" class="close" data-close>&times;</button>
		</div>
		<div class="arch-modal-body">
			<label for="arch-mkdir-name">Nome cartella</label>
			<input type="text" id="arch-mkdir-name" placeholder="es. Comunicati 2026" maxlength="120">
		</div>
		<div class="arch-modal-footer">
			<button type="button" class="btn btn-muted" data-close>Annulla</button>
			<button type="button" class="btn btn-primary" id="arch-mkdir-confirm">Crea</button>
		</div>
	</div>
</div>

<!-- Modal conferma -->
<div class="arch-modal-backdrop" id="arch-modal-confirm">
	<div class="arch-modal">
		<div class="arch-modal-header">
			<h3 id="arch-confirm-title">Conferma</h3>
			<button type="button" class="close" data-close>&times;</button>
		</div>
		<div class="arch-modal-body">
			<p id="arch-confirm-text" style="margin:0; font-size:15px;"></p>
		</div>
		<div class="arch-modal-footer">
			<button type="button" class="btn btn-muted" data-close>Annulla</button>
			<button type="button" class="btn btn-danger" id="arch-confirm-ok">Elimina</button>
		</div>
	</div>
</div>

<!-- Modal sposta -->
<div class="arch-modal-backdrop" id="arch-modal-move">
	<div class="arch-modal">
		<div class="arch-modal-header">
			<h3>Sposta file</h3>
			<button type="button" class="close" data-close>&times;</button>
		</div>
		<div class="arch-modal-body">
			<p style="margin-top:0; color:#555;">Seleziona la cartella di destinazione:</p>
			<div class="tree-list" id="arch-move-tree"></div>
		</div>
		<div class="arch-modal-footer">
			<button type="button" class="btn btn-muted" data-close>Annulla</button>
			<button type="button" class="btn btn-warn" id="arch-move-confirm" disabled>Sposta qui</button>
		</div>
	</div>
</div>

<!-- Modal preview -->
<div class="arch-modal-backdrop" id="arch-modal-preview">
	<div class="arch-modal wide">
		<div class="arch-modal-header">
			<h3 id="arch-preview-title">Anteprima</h3>
			<button type="button" class="close" data-close>&times;</button>
		</div>
		<div class="arch-modal-body" id="arch-preview-body" style="padding:0;"></div>
		<div class="arch-modal-footer">
			<a class="btn btn-primary" id="arch-preview-download" href="#" download target="_blank"><i class="fa fa-download"></i> Scarica</a>
			<button type="button" class="btn btn-muted" data-close>Chiudi</button>
		</div>
	</div>
</div>

<script>
(function ($) {
	var API = 'frame/archivio_api.php';
	var state = { path: '', folders: [], files: [], selected: {}, moveDest: null };

	function esc(s) {
		return String(s == null ? '' : s)
			.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
	}

	function msg(text, type) {
		var $m = $('#arch-msg');
		$m.removeClass('ok err info').addClass(type || 'info').text(text).show();
		if (type !== 'err') {
			setTimeout(function () { $m.fadeOut(); }, 4000);
		}
	}

	function openModal(id) { $(id).addClass('open'); }
	function closeModal(id) { $(id).removeClass('open'); }
	$(document).on('click', '[data-close]', function () {
		$(this).closest('.arch-modal-backdrop').removeClass('open');
	});
	$(document).on('click', '.arch-modal-backdrop', function (e) {
		if (e.target === this) $(this).removeClass('open');
	});

	function selectedPaths() {
		return Object.keys(state.selected).filter(function (k) { return state.selected[k]; });
	}

	function updateBulkButtons() {
		var n = selectedPaths().length;
		$('#arch-btn-move, #arch-btn-delete-many').prop('disabled', n === 0);
	}

	function iconFor(ext, isDir) {
		if (isDir) return '<i class="fa fa-folder icon folder"></i>';
		ext = (ext || '').toLowerCase();
		if (ext === 'pdf') return '<i class="fa fa-file-pdf icon" style="color:#c0392b"></i>';
		if (['jpg','jpeg','png','gif','webp','svg'].indexOf(ext) >= 0) return '<i class="fa fa-file-image icon" style="color:#27ae60"></i>';
		if (['mp4','webm','mov'].indexOf(ext) >= 0) return '<i class="fa fa-file-video icon" style="color:#8e44ad"></i>';
		if (['doc','docx'].indexOf(ext) >= 0) return '<i class="fa fa-file-word icon" style="color:#2980b9"></i>';
		if (['xls','xlsx'].indexOf(ext) >= 0) return '<i class="fa fa-file-excel icon" style="color:#1e8449"></i>';
		if (['zip','rar','7z'].indexOf(ext) >= 0) return '<i class="fa fa-file-archive icon" style="color:#f39c12"></i>';
		return '<i class="fa fa-file icon"></i>';
	}

	function formatDate(ts) {
		if (!ts) return '—';
		var d = new Date(ts * 1000);
		function z(n) { return n < 10 ? '0' + n : n; }
		return z(d.getDate()) + '/' + z(d.getMonth() + 1) + '/' + d.getFullYear() + ' ' + z(d.getHours()) + ':' + z(d.getMinutes());
	}

	function renderCrumbs() {
		var html = '<a href="#" data-path="">Archivio</a>';
		(state.crumbs || []).forEach(function (c) {
			html += '<span class="sep">/</span><a href="#" data-path="' + esc(c.path) + '">' + esc(c.name) + '</a>';
		});
		$('#arch-crumbs').html(html);
	}

	function renderListing() {
		renderCrumbs();
		var rows = '';
		state.folders.forEach(function (f) {
			rows += '<tr>' +
				'<td style="width:36px"></td>' +
				'<td><div class="name-cell">' + iconFor('', true) +
				'<a href="#" class="arch-open-dir" data-path="' + esc(f.path) + '">' + esc(f.name) + '</a>' +
				'<span style="color:#999;font-size:12px;font-weight:normal">(' + f.items + ')</span></div></td>' +
				'<td>—</td>' +
				'<td>' + esc(formatDate(f.mtime)) + '</td>' +
				'<td>—</td>' +
				'<td class="arch-actions">' +
				(f.empty
					? '<button type="button" class="del arch-del-dir" data-path="' + esc(f.path) + '" data-name="' + esc(f.name) + '" title="Elimina cartella"><i class="fa fa-trash"></i></button>'
					: '<button type="button" class="del arch-del-dir-full" data-path="' + esc(f.path) + '" data-name="' + esc(f.name) + '" data-items="' + esc(f.items) + '" title="Cartella non vuota"><i class="fa fa-trash"></i></button>') +
				'</td></tr>';
		});
		state.files.forEach(function (f) {
			var checked = state.selected[f.path] ? ' checked' : '';
			rows += '<tr>' +
				'<td><input type="checkbox" class="arch-check" data-path="' + esc(f.path) + '"' + checked + '></td>' +
				'<td><div class="name-cell">' + iconFor(f.ext, false) + '<span>' + esc(f.name) + '</span></div></td>' +
				'<td>' + esc(f.size_label) + '</td>' +
				'<td>' + esc(formatDate(f.mtime)) + '</td>' +
				'<td><div class="arch-link-row">' +
				'<input type="text" readonly value="' + esc(f.url) + '" id="link-' + esc(f.path.replace(/[\/\\]/g, '_')) + '">' +
				'<button type="button" class="arch-copy-link" data-url="' + esc(f.url) + '">Copia</button>' +
				'</div></td>' +
				'<td class="arch-actions">' +
				(f.previewable ? '<button type="button" class="arch-preview" data-url="' + esc(f.url) + '" data-name="' + esc(f.name) + '" data-ext="' + esc(f.ext) + '" title="Anteprima"><i class="fa fa-eye"></i></button>' : '') +
				'<a href="' + esc(f.url) + '" download="' + esc(f.name) + '" title="Scarica" target="_blank"><i class="fa fa-download"></i></a>' +
				'<button type="button" class="del arch-del-file" data-path="' + esc(f.path) + '" data-name="' + esc(f.name) + '" title="Elimina"><i class="fa fa-trash"></i></button>' +
				'</td></tr>';
		});

		if (!rows) {
			$('#arch-listing').html('<div class="arch-empty">Cartella vuota. Crea una sottocartella o carica dei file.</div>');
			return;
		}

		var html = '<table class="arch-table"><thead><tr>' +
			'<th style="width:36px"><input type="checkbox" id="arch-check-all" title="Seleziona tutti i file"></th>' +
			'<th>Nome</th><th style="width:90px">Dimensione</th><th style="width:140px">Modificato</th>' +
			'<th style="width:420px">Link pubblico</th><th style="width:140px">Azioni</th>' +
			'</tr></thead><tbody>' + rows + '</tbody></table>';
		$('#arch-listing').html(html);
		updateBulkButtons();
	}

	function load(path) {
		state.path = path == null ? state.path : path;
		state.selected = {};
		$.getJSON(API, { action: 'list', path: state.path })
			.done(function (res) {
				if (!res.ok) { msg(res.error || 'Errore', 'err'); return; }
				state.path = res.path;
				state.crumbs = res.crumbs;
				state.folders = res.folders || [];
				state.files = res.files || [];
				renderListing();
			})
			.fail(function (xhr) {
				var err = (xhr.responseJSON && xhr.responseJSON.error) || 'Errore di comunicazione';
				msg(err, 'err');
			});
	}

	function confirmAction(title, text, onOk) {
		$('#arch-confirm-title').text(title);
		$('#arch-confirm-text').text(text);
		$('#arch-confirm-ok').off('click').on('click', function () {
			closeModal('#arch-modal-confirm');
			onOk();
		});
		openModal('#arch-modal-confirm');
	}

	function renderTree(node, depth) {
		depth = depth || 0;
		var html = '<div class="tree-item" data-path="' + esc(node.path) + '">' +
			'<span class="pad" style="width:' + (depth * 16) + 'px"></span>' +
			'<i class="fa fa-folder" style="color:#e67e22;margin-right:6px"></i>' + esc(node.name) +
			'</div>';
		(node.children || []).forEach(function (c) {
			html += renderTree(c, depth + 1);
		});
		return html;
	}

	/* ---- Events ---- */
	$('#arch-btn-refresh').on('click', function () { load(state.path); });

	$('#arch-crumbs').on('click', 'a[data-path]', function (e) {
		e.preventDefault();
		load($(this).data('path'));
	});

	$('#arch-listing').on('click', '.arch-open-dir', function (e) {
		e.preventDefault();
		load($(this).data('path'));
	});

	$('#arch-listing').on('change', '.arch-check', function () {
		state.selected[$(this).data('path')] = this.checked;
		updateBulkButtons();
	});

	$('#arch-listing').on('change', '#arch-check-all', function () {
		var on = this.checked;
		state.selected = {};
		$('.arch-check').each(function () {
			this.checked = on;
			if (on) state.selected[$(this).data('path')] = true;
		});
		updateBulkButtons();
	});

	$('#arch-listing').on('click', '.arch-copy-link', function () {
		var url = $(this).data('url');
		var $btn = $(this);
		function done() {
			$btn.addClass('copied').text('Copiato!');
			setTimeout(function () { $btn.removeClass('copied').text('Copia'); }, 1500);
		}
		if (navigator.clipboard && navigator.clipboard.writeText) {
			navigator.clipboard.writeText(url).then(done).catch(function () {
				window.prompt('Copia il link:', url);
			});
		} else {
			window.prompt('Copia il link:', url);
			done();
		}
	});

	$('#arch-btn-mkdir').on('click', function () {
		$('#arch-mkdir-name').val('');
		openModal('#arch-modal-mkdir');
		setTimeout(function () { $('#arch-mkdir-name').focus(); }, 50);
	});

	$('#arch-mkdir-confirm').on('click', function () {
		var name = $.trim($('#arch-mkdir-name').val());
		if (!name) { msg('Inserisci un nome cartella', 'err'); return; }
		$.ajax({ url: API, type: 'POST', dataType: 'json', data: { action: 'mkdir', path: state.path, name: name } })
			.done(function (res) {
				if (!res.ok) { msg(res.error || 'Errore', 'err'); return; }
				closeModal('#arch-modal-mkdir');
				msg('Cartella creata', 'ok');
				load(state.path);
			})
			.fail(function (xhr) {
				msg((xhr.responseJSON && xhr.responseJSON.error) || 'Errore', 'err');
			});
	});

	$('#arch-mkdir-name').on('keydown', function (e) {
		if (e.key === 'Enter') $('#arch-mkdir-confirm').click();
	});

	$('#arch-file-input').on('change', function () {
		var files = this.files;
		if (!files || !files.length) return;

		var fd = new FormData();
		fd.append('action', 'upload');
		fd.append('path', state.path);
		for (var i = 0; i < files.length; i++) {
			fd.append('files[]', files[i]);
		}

		$('#arch-upload-progress').show();
		$('#arch-upload-bar').css('width', '0%');
		$('#arch-upload-label').text('Caricamento 0%…');

		$.ajax({
			url: API,
			type: 'POST',
			dataType: 'json',
			data: fd,
			processData: false,
			contentType: false,
			xhr: function () {
				var xhr = $.ajaxSettings.xhr();
				if (xhr.upload) {
					xhr.upload.addEventListener('progress', function (e) {
						if (e.lengthComputable) {
							var pct = Math.round((e.loaded / e.total) * 100);
							$('#arch-upload-bar').css('width', pct + '%');
							$('#arch-upload-label').text('Caricamento ' + pct + '%…');
						}
					});
				}
				return xhr;
			}
		}).done(function (res) {
			$('#arch-upload-bar').css('width', '100%');
			$('#arch-upload-label').text('Completato');
			setTimeout(function () { $('#arch-upload-progress').fadeOut(); }, 800);
			if (!res.ok) {
				var detail = (res.failed || []).map(function (f) { return f.name + ': ' + f.error; }).join('; ');
				msg(res.error + (detail ? ' — ' + detail : ''), 'err');
			} else {
				msg('Caricati ' + (res.saved || []).length + ' file', 'ok');
			}
			load(state.path);
		}).fail(function (xhr) {
			$('#arch-upload-progress').hide();
			msg((xhr.responseJSON && xhr.responseJSON.error) || 'Upload fallito', 'err');
		});

		this.value = '';
	});

	$('#arch-listing').on('click', '.arch-del-file', function () {
		var path = $(this).data('path');
		var name = $(this).data('name');
		confirmAction('Elimina file', 'Eliminare definitivamente «' + name + '»?', function () {
			$.ajax({ url: API, type: 'POST', dataType: 'json', data: { action: 'delete', path: path, is_dir: 0 } })
				.done(function (res) {
					if (!res.ok) { msg(res.error || 'Errore', 'err'); return; }
					msg('File eliminato', 'ok');
					load(state.path);
				})
				.fail(function (xhr) {
					msg((xhr.responseJSON && xhr.responseJSON.error) || 'Errore', 'err');
				});
		});
	});

	$('#arch-listing').on('click', '.arch-del-dir', function () {
		var path = $(this).data('path');
		var name = $(this).data('name');
		confirmAction('Elimina cartella', 'Eliminare la cartella vuota «' + name + '»?', function () {
			$.ajax({ url: API, type: 'POST', dataType: 'json', data: { action: 'delete', path: path, is_dir: 1 } })
				.done(function (res) {
					if (!res.ok) { msg(res.error || 'Errore', 'err'); return; }
					msg('Cartella eliminata', 'ok');
					load(state.path);
				})
				.fail(function (xhr) {
					msg((xhr.responseJSON && xhr.responseJSON.error) || 'Errore', 'err');
				});
		});
	});

	$('#arch-listing').on('click', '.arch-del-dir-full', function () {
		var name = $(this).data('name');
		var items = parseInt($(this).data('items'), 10) || 0;
		var nLabel = items === 1 ? '1 elemento' : items + ' elementi';
		alert(
			'Impossibile eliminare la cartella «' + name + '».\n\n' +
			'La cartella non è vuota (contiene ' + nLabel + ').\n' +
			'Per cancellarla, elimina prima tutti i file e le sottocartelle al suo interno.'
		);
	});

	$('#arch-btn-delete-many').on('click', function () {
		var paths = selectedPaths();
		if (!paths.length) return;
		confirmAction('Elimina file', 'Eliminare ' + paths.length + ' file selezionati?', function () {
			$.ajax({
				url: API,
				type: 'POST',
				dataType: 'json',
				contentType: 'application/json',
				data: JSON.stringify({ action: 'delete_many', paths: paths })
			}).done(function (res) {
				if (!res.ok) {
					msg(res.error || 'Errore', 'err');
				} else {
					msg('Eliminati ' + (res.deleted || []).length + ' file', 'ok');
				}
				load(state.path);
			}).fail(function (xhr) {
				msg((xhr.responseJSON && xhr.responseJSON.error) || 'Errore', 'err');
			});
		});
	});

	$('#arch-btn-move').on('click', function () {
		var paths = selectedPaths();
		if (!paths.length) return;
		state.moveDest = null;
		$('#arch-move-confirm').prop('disabled', true);
		$.getJSON(API, { action: 'tree' }).done(function (res) {
			if (!res.ok) { msg(res.error || 'Errore', 'err'); return; }
			$('#arch-move-tree').html(renderTree(res.tree));
			openModal('#arch-modal-move');
		});
	});

	$('#arch-move-tree').on('click', '.tree-item', function () {
		$('#arch-move-tree .tree-item').removeClass('selected');
		$(this).addClass('selected');
		state.moveDest = $(this).data('path');
		$('#arch-move-confirm').prop('disabled', false);
	});

	$('#arch-move-confirm').on('click', function () {
		var paths = selectedPaths();
		if (state.moveDest == null) return;
		$.ajax({
			url: API,
			type: 'POST',
			dataType: 'json',
			contentType: 'application/json',
			data: JSON.stringify({ action: 'move', paths: paths, dest: state.moveDest })
		}).done(function (res) {
			closeModal('#arch-modal-move');
			if (!res.ok) {
				msg(res.error || 'Errore nello spostamento', 'err');
			} else {
				msg('Spostati ' + (res.moved || []).length + ' file', 'ok');
			}
			load(state.path);
		}).fail(function (xhr) {
			msg((xhr.responseJSON && xhr.responseJSON.error) || 'Errore', 'err');
		});
	});

	$('#arch-listing').on('click', '.arch-preview', function () {
		var url = $(this).data('url');
		var name = $(this).data('name');
		var ext = String($(this).data('ext') || '').toLowerCase();
		$('#arch-preview-title').text(name);
		$('#arch-preview-download').attr({ href: url, download: name });
		var body = '';
		if (['jpg','jpeg','png','gif','webp','svg'].indexOf(ext) >= 0) {
			body = '<div style="padding:16px;text-align:center"><img class="arch-preview-img" src="' + esc(url) + '" alt=""></div>';
		} else if (['mp4','webm'].indexOf(ext) >= 0) {
			body = '<video class="arch-preview-frame" controls src="' + esc(url) + '"></video>';
		} else if (ext === 'txt') {
			body = '<iframe class="arch-preview-frame" src="' + esc(url) + '"></iframe>';
		} else {
			// PDF e simili
			body = '<iframe class="arch-preview-frame" src="' + esc(url) + '"></iframe>';
		}
		$('#arch-preview-body').html(body);
		openModal('#arch-modal-preview');
	});

	load('');
})(jQuery);
</script>
