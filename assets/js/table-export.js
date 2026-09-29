(function () {
  'use strict';

  function csvValue(value) {
    var text = String(value == null ? '' : value).replace(/\s+/g, ' ').trim();
    if (/^[=+\-@\t\r]/.test(text)) text = "'" + text;
    return '"' + text.replace(/"/g, '""') + '"';
  }

  function visibleRows(table) {
    return Array.prototype.slice.call(table.querySelectorAll('tr')).filter(function (row) {
      return !row.closest('[hidden], .is-hidden') && getComputedStyle(row).display !== 'none' && !row.hasAttribute('data-empty-state') && !row.querySelector('[data-empty-state]') && row.id.indexOf('-filter-empty') === -1;
    });
  }

  function tableCsv(table) {
    if (!table.getClientRects().length || table.closest('[hidden], .is-hidden')) return '';
    var rows = visibleRows(table);
    if (!rows.length) return '';
    var header = table.tHead && table.tHead.rows.length ? table.tHead.rows[0] : null;
    var excludedColumns = [];
    if (header) {
      Array.prototype.slice.call(header.cells).forEach(function (cell, index) {
        if (/^actions?$/i.test((cell.innerText || cell.textContent).trim())) excludedColumns.push(index);
      });
    }

    return rows.map(function (row) {
      return Array.prototype.slice.call(row.querySelectorAll('th, td')).filter(function (cell, index) {
        return excludedColumns.indexOf(index) === -1;
      }).map(function (cell) {
        return csvValue(cell.innerText || cell.textContent);
      }).join(',');
    }).join('\r\n');
  }

  function announce(button, message) {
    var status = button.parentElement && button.parentElement.querySelector('[data-export-status]');
    if (!status) {
      status = document.createElement('span');
      status.setAttribute('data-export-status', '');
      status.setAttribute('role', 'status');
      status.style.marginInlineStart = '8px';
      status.style.fontSize = '13px';
      button.insertAdjacentElement('afterend', status);
    }
    status.textContent = message;
  }

  document.addEventListener('click', function (event) {
    var button = event.target.closest && event.target.closest('[data-export-table], [data-export-all-tables]');
    if (!button) return;

    event.preventDefault();
    var tables = button.hasAttribute('data-export-all-tables')
      ? Array.prototype.slice.call(document.querySelectorAll('main table'))
      : [document.querySelector(button.getAttribute('data-export-table'))].filter(Boolean);
    var sections = tables.map(tableCsv).filter(Boolean);

    if (!sections.length) {
      announce(button, 'No visible rows to export.');
      return;
    }

    var blob = new Blob(['\ufeff' + sections.join('\r\n\r\n')], { type: 'text/csv;charset=utf-8' });
    var url = URL.createObjectURL(blob);
    var link = document.createElement('a');
    var name = (button.getAttribute('data-export-name') || 'sams-report').replace(/[^a-z0-9_-]+/gi, '-');
    link.href = url;
    link.download = name + '.csv';
    document.body.appendChild(link);
    link.click();
    link.remove();
    window.setTimeout(function () { URL.revokeObjectURL(url); }, 1000);
    announce(button, 'CSV downloaded.');
  });
}());