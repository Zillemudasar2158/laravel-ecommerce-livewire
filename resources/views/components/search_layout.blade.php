{{-- Search UI --}}
<div class="relative mb-6">
    <input type="text" id="search-input" placeholder="What are you looking for today?" 
           class="w-full px-4 py-2 border rounded shadow focus:outline-none" autocomplete="off">
    <ul id="suggestion-box" class="absolute z-50 bg-white border rounded w-full hidden max-h-60 overflow-y-auto"></ul>
</div>

<script>

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('search-input');
    const box = document.getElementById('suggestion-box');
    let selectedIndex = -1;

    // Close suggestions when clicked outside
    document.addEventListener('click', function (e) {
        if (!box.contains(e.target) && e.target !== input) {
            box.classList.add('hidden');
        }
    });

    input.addEventListener('input', function () {
        const query = this.value.trim();
        if (query.length > 1) {
            fetch(`/search-all?q=${query}`)
                .then(res => res.json())
                .then(data => {
                    box.innerHTML = '';
                    selectedIndex = -1;

                    if (
                        data.categories.length === 0 &&
                        data.subcategories.length === 0 &&
                        data.products.length === 0
                    ) {
                        box.innerHTML = `<li class="px-4 py-2 text-gray-500">No results found</li>`;
                    } else {
                        // Categories
                        data.categories.forEach(cat => {
                            const li = document.createElement('li');
                            li.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer text-blue-600';
                            li.textContent = `📦 ${cat.cat_name}`;
                            li.onclick = () => {
                                window.location.href = `/cat/${cat.id}`;
                            };
                            box.appendChild(li);
                        });

                        // Subcategories
                        data.subcategories.forEach(sub => {
                            const li = document.createElement('li');
                            li.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer text-green-700';

                            const catName = sub.category?.cat_name || 'Unknown';
                            li.textContent = `➤ ${sub.subcat_name} (${catName})`;

                            li.onclick = () => {
                                window.location.href = `/cat/${sub.categories_id}&${sub.id}`;
                            };
                            box.appendChild(li);
                        });

                        // Products
                        data.products.forEach(prod => {
                            const li = document.createElement('li');
                            li.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-800';
                            li.textContent = `🛒(${prod.product_code}) ${prod.name} `;
                            li.onclick = () => {
                                window.location.href = `/searchproduct/${prod.id}`;
                            };
                            box.appendChild(li);
                        });
                    }

                    box.classList.remove('hidden');
                })
                .catch(err => {
                    console.error('Search error:', err);
                });
        } else {
            box.classList.add('hidden');
        }
    });

    // Handle arrow key navigation
    input.addEventListener('keydown', function (e) {
        const items = box.querySelectorAll('li');
        if (!items.length) return;

        if (e.key === 'ArrowDown') {
            selectedIndex = (selectedIndex + 1) % items.length;
        } else if (e.key === 'ArrowUp') {
            selectedIndex = (selectedIndex - 1 + items.length) % items.length;
        } else if (e.key === 'Enter' && selectedIndex >= 0) {
            items[selectedIndex].click();
        }

        items.forEach((el, idx) => {
            el.classList.toggle('bg-gray-200', idx === selectedIndex);
        });
    });
});


</script>
