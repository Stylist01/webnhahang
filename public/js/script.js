function preview_thumbail(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img')
                .attr('src', e.target.result)
                .width(100)
                .height(auto)
        };
        reader.readAsDataURL(input.files[0]);
    }
};

function preview_thumbail_logo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#logo')
                .attr('src', e.target.result)
                .width(100)
                .height(auto)
        };
        reader.readAsDataURL(input.files[0]);
    }
};

function preview_thumbail_banner(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#banner')
                .attr('src', e.target.result)
                .width(200)
                .height(auto)
        };
        reader.readAsDataURL(input.files[0]);
    }
};