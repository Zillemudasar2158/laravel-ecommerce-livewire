<div>
    <button wire:click="delete" class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-red-600">
        Delete
    </button>

    <script>
        document.addEventListener('coupon-deleted', () => {
            window.location.reload();
        });
    </script>
</div>
