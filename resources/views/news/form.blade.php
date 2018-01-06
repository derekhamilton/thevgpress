{!! Form::open(['url' => '', 'id' => 'newsForm', 'class' => 'ajax', 'style' => 'max-width: 600px']) !!}
    <h3>Post News Article</h3>

    <div class="form-group row">
        <div class="col-sm-4">Title</div>
        <div class="col-sm-8">
            {!! Form::textarea('title', '', ['class' => 'form-control', 'rows' => 3]) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4">Description</div>
        <div class="col-sm-8">
            {!! Form::text('description', '', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4">Link</div>
        <div class="col-sm-8">
            {!! Form::text('link', '', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4">Company</div>
        <div class="col-sm-8">
            <label>
                {!! Form::radio('company', 'none', true) !!}
                <span class="none">None</span>
            </label>
            <label>
                {!! Form::radio('company', 'microsoft') !!}
                <span class="microsoft">Microsoft</span>
            </label>
            <label>
                {!! Form::radio('company', 'nintendo') !!}
                <span class="nintendo">Nintendo</span>
            </label>
            <label>
                {!! Form::radio('company', 'sony') !!}
                <span class="sony">Sony</span>
            </label>
            <label>
                {!! Form::radio('company', 'pc') !!}
                <span class="pc">PC</span>
            </label>
            <label>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4">Type</div>
        <div class="col-sm-8">
            <label>
                {!! Form::checkbox('news', 1) !!}
                News
            </label>
            <label>
                {!! Form::checkbox('media', 1) !!}
                Media
            </label>
            <label>
                {!! Form::checkbox('impressions', 1) !!}
                Impressions
            </label>
            <label>
                {!! Form::checkbox('editorial', 1) !!}
                Editorial
            </label>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4">Big News?</div>
        <div class="col-sm-8">
            <label>
                {!! Form::checkbox('bigNews', 1) !!}
            </label>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-xs-12">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
{!! Form::close() !!}
