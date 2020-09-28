<div class="form-group">
    <input type="file" name="thumbnail" id="thumbnail">
    <div class="text-danger mt-2">
        @error('thumbnail')
            {{$message}}
        @enderror
        </div>
</div>
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{old('title')??$post->title}}">
    <div class="text-danger mt-2">
    @error('title')
        {{$message}}
    @enderror
    </div>
</div>
<div class="form-group">
    <label for='category'>Category</label>
    <select name="category" id="category" class="form-control">
        <option  value="" disabled selected>Choose one</option>
        @foreach ($category as $category)
        <option value="{{$category->id}}" {{$category->id == $post->category_id ? 'selected' : ""}}>{{$category->name}}</option>    
        @endforeach
    </select>
    <div class="text-danger mt-2">
        @error('category')
        {{$message}}
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" id="tags" class="form-control" multiple>
        <option value="" disabled selected >Choose one</option>
        @foreach ($post->tags as $tagg)
        <option selected value="{{$tagg->id}}">{{$tagg->name}}</option>    
        @endforeach
            @foreach ($tag as $tagg)
            <option value="{{$tagg->id}}">{{$tagg->name}}</option>    
            @endforeach
    </select>
    <div class="text-danger mt-2">
        @error('tags')
        {{$message}}
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" id="body" class="form-control">{{old('body')??$post->body}}</textarea>
    <div class="text-danger mt-2">
        @error('body')
        {{$message}}
        @enderror
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>