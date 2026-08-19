import './echo';

document.addEventListener('DOMContentLoaded', () => {
    if (window.Echo) {
        window.Echo.channel('scholarships')
            .listen('.scholarship.created', (e) => {
                if (typeof showToast === 'function') {
                    showToast(`<strong>Beasiswa Baru!</strong><br>${e.scholarship.title} baru saja ditambahkan.`, 'success');
                }
            })
            .listen('.scholarship.updated', (e) => {
                if (typeof showToast === 'function') {
                    showToast(`<strong>Beasiswa Diperbarui!</strong><br>Info ${e.scholarship.title} telah diubah.`, 'info');
                }
            })
            .listen('.scholarship.deleted', (e) => {
                if (typeof showToast === 'function') {
                    showToast(`<strong>Beasiswa Dihapus!</strong><br>Sebuah beasiswa baru saja ditarik.`, 'info');
                }
            });
    }
});
