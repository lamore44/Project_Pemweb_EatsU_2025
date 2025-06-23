document.addEventListener("DOMContentLoaded", () => {
    const topMenu = document.getElementById('top-menu');
    const topKantin = document.getElementById('top-kantin');
    const detailMenu = document.getElementById('detail-menu');
    const detailKantin = document.getElementById('detail-kantin');

    const viewMoreMenu = document.getElementById('view-more-menu');
    const viewMoreKantin = document.getElementById('view-more-kantin');

    const backMenu = document.getElementById('back-menu');
    const backKantin = document.getElementById('back-kantin');

    viewMoreMenu.addEventListener('click', () => {
        detailMenu.style.display = 'block';
        topKantin.style.display = 'none';
        detailKantin.style.display = 'none';
        backMenu.style.display = 'block';
        backKantin.style.display = 'none';
        detailMenu.scrollIntoView({ behavior: 'smooth' });
    });

    viewMoreKantin.addEventListener('click', () => {
        detailKantin.style.display = 'block';
        topMenu.style.display = 'none';
        detailMenu.style.display = 'none';
        backKantin.style.display = 'block';
        backMenu.style.display = 'none';
        detailKantin.scrollIntoView({ behavior: 'smooth' });
    });

    backMenu.addEventListener('click', () => {
        detailMenu.style.display = 'none';
        topKantin.style.display = 'block';
        backMenu.style.display = 'none';
    });

    backKantin.addEventListener('click', () => {
        detailKantin.style.display = 'none';
        topMenu.style.display = 'block';
        backKantin.style.display = 'none';
    });
});


