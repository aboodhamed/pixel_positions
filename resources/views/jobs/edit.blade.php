<x-layout>
    <x-page-heading>Edit Job</x-page-heading>

    <x-forms.form method="POST" action="{{ route('jobs.update', $job->id) }}">
        @method('PUT') <!-- Specify the method as PUT for update -->

        <!-- Title Input with existing value -->
        <x-forms.input label="Title" name="title" placeholder="CEO" value="{{ old('title', $job->title) }}" />

        <!-- Salary Input with existing value -->
        <x-forms.input label="Salary" name="salary" placeholder="$90,000 USD" value="{{ old('salary', $job->salary) }}" />

        <!-- Location Input with existing value -->
        <x-forms.input label="Location" name="location" placeholder="Winter Park, Florida" value="{{ old('location', $job->location) }}" />

        <!-- Schedule Select with existing value -->
        <x-forms.select label="Schedule" name="schedule">
            <option value="full-time" {{ old('schedule', $job->schedule) == 'full-time' ? 'selected' : '' }}>Full Time</option>
            <option value="part-time" {{ old('schedule', $job->schedule) == 'part-time' ? 'selected' : '' }}>Part Time</option>
        </x-forms.select>

        <!-- URL Input with existing value -->
        <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted" value="{{ old('url', $job->url) }}" />

        <!-- Featured Checkbox with existing value -->
    <x-forms.checkbox label="Feature (Costs Extra)" value="1" name="featured" :checked="old('featured', $job->featured)" />

        <x-forms.divider />

        <!-- Tags Input with existing value -->
        <x-forms.input  label="Tags (comma separated)" name="tags"  placeholder="Laracasts, video, education" value="{{ old('tags', $job->tags->pluck('name')->join(', ')) }}" />
        <!-- Submit Button -->
        <x-forms.button>Update</x-forms.button>
    </x-forms.form>
</x-layout>
