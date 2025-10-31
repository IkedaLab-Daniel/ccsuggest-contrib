{{-- resources/views/admin/partials/retrain-card.blade.php --}}
<div
    x-data="{
      loading: false,
      result: null,
      async run() {
        this.loading = true;
        this.result  = null;
        try {
          const res = await fetch('{{ route('admin.system.retrain') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json'
            },
            body: JSON.stringify({})
          });
          const json = await res.json();
          if (res.ok) {
            this.result = { type: 'success', text: json.message || (`Done in ${json.duration}s`) };
          } else {
            this.result = { type: 'error', text: json.message || 'Unknown error' };
          }
        } catch (err) {
          this.result = { type: 'error', text: err.message };
        } finally {
          this.loading = false;
        }
      }
    }"
    class="group bg-white p-6 rounded-lg shadow hover:shadow-lg transition"
>
  <div class="flex items-center justify-between">
    <div class="flex items-center">
      <svg class="h-8 w-8 text-yellow-500 group-hover:text-yellow-600"
           fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v8m4-4H8"/>
      </svg>
      <span class="ml-4 text-lg font-medium">Retrain Model</span>
    </div>
    <button
        x-show="! loading"
        @click.prevent="run()"
        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition"
    >
      Retrain Now
    </button>
    <button
        x-show="loading"
        disabled
        class="inline-flex items-center bg-yellow-500 text-white px-4 py-2 rounded opacity-60"
    >
      <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <circle cx="12" cy="12" r="10" stroke-width="4" class="opacity-25"/>
        <path d="M4 12a8 8 0 018-8" stroke-width="4" class="opacity-75"/>
      </svg>
      Retraining…
    </button>
  </div>

  <p class="mt-2 text-gray-600 group-hover:text-gray-800">
    Rebuild the decision-tree with the latest data.
  </p>

  <template x-if="result">
    <div
      x-text="result.text"
      :class="{
        'mt-4 px-4 py-2 rounded': true,
        'bg-green-100 text-green-800': result.type==='success',
        'bg-red-100 text-red-800': result.type==='error'
      }"
    ></div>
  </template>
</div>
