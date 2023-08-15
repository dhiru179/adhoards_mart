@extends('admin.layouts.app')
@section('title', 'add product')
{{-- @section('dash', 'active') --}}
@section('content')

    <div class="container">
        <div class="mt-3 col-12 row">
            <div class="col-3" id="clasified">
                <div class="mb-3">
                    <select class="form-select" onchange="category(this)" level="1" id="category">
                        <option class="text-muted" value="">category</option>
                        @foreach ($product_category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-9">
                <form id="formTable">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">category</th>
                                <th scope="col">slug</th>
                                <th scope="col">icon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>
                                <th scope="row">1</th>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="category[]">
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" name="slugs[]">
                                </td>
                                <td></td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </form>
                <div class="d-flex">
                    <button class="btn btn-success mx-3" onclick="addRow()">Add</button>

                    <button class="btn btn-info mx-3" id="save">save</button>
                </div>


            </div>
        </div>
    </div>

    <script>
        let count = 1;
        let optionCount = 0;
        let arr = {};
        let currentId = null;
        let objForm = {

            formHtml: (slug, count) => {
                if (slug === 'tr') {
                    return `<tr id="tr${count}">
                <th scope="row">${count}</th>
             
                <td>
                    <input type="text" class="form-control" name="category[]">
                </td>
                <td>
                    <input type="text" class="form-control" name="slugs[]">
                </td>
                <td></td>

               
                <td>
                    <button class="btn btn-sm btn-danger" onclick=removeRow(${count})>x</button>
                </td>

            </tr>`;
                }

                return false;

            },

            post: (obj) => {
                $.ajax({
                    type: "POST",
                    url: obj.url,
                    data: obj.data,
                    success: function(response) {
                        console.log(response);

                        if (response.status) {
                            alert(response.msg);
                            if (obj.slug == 'getSubCategory') {
                                objForm.getSubCategory(response.data, obj.level);
                            } else if (obj.slug == "category") {
                                // alert(response.msg);
                                window.location.reload();
                            }
                        }

                    },
                    error: (err) => console.log(err),
                });
            },
            getSubCategory: (res, level) => {
                console.log(res)
                let option = `<option value="">--</option>`;
                // level
                $('#clasified [level]').each(function() {
                    if (parseInt($(this).attr('level')) > level) {
                        $(this).parent().remove();
                    }
                })
                if (res.length > 0) {
                    res.forEach((elem, index) => {
                        option += `<option value="${elem.id}">${elem.name}</option>`;
                    })
                    const html = `<div class="mb-3">
                     <select class="form-select" onchange="category(this)" level="${++level}" id="sub_category">
                        ${option}
                     </select>
                </div>`;
                    $('#clasified').append(html);
                }

            },
        }

        function addRow() {
            count++;
            $('#tbody').append(objForm.formHtml('tr', count));
        }

        function removeRow(id) {
            $('#tr' + id).remove();
        }

        function category(elem) {
            let level = parseInt($(elem).attr('level'))
            currentId = elem.value;
            console.log(currentId)
            let data = new FormData();
            data.append('current_id', currentId);
            const obj = {
                data: data,
                url: "{{ route('fetch.product_category') }}",
                slug: "getSubCategory",
                level: level,
            }
            // console.log(data);
            objForm.post(obj);
        }




        $('#save').click((e) => {
            let formData = $('#formTable').serializeArray();
            let data = new FormData();
            formData.forEach(function(input, value) {
                data.append(input.name, input.value);
            })
            data.append('parent_id', currentId);

            const obj = {
                data: data,
                url: "{{ route('admin.product-category-store') }}",
                slug: "category",
            }
            // console.log(data);
            objForm.post(obj);

        })
    </script>

@endsection
