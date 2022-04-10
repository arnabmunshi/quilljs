<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quill JS</title>
  <!-- Include stylesheet -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>
  <!-- Create the editor container -->
  <div id="editor"></div>

  <textarea class="textbox" cols="30" rows="10"></textarea>

  <button class="getcontent-btn">Get Content</button>

  <!-- Include the Quill library -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <!-- Initialize Quill editor -->
  <script>
    // get content from db
    var content = <?='{"ops":[{"insert":"Hello World!\nSome initial "},{"attributes":{"bold":true},"insert":"bold"},{"insert":" text\n\nThis quilljs\n"}]}'; ?>;

    // extract the main content as array
    var contentArray = content.ops;

    var quill = new Quill('#editor', {
      theme: 'snow'
    });

    /* quill.setContents([
      { insert: 'Hello ' },
      { insert: 'World!', attributes: { bold: true } },
      { insert: '\n' }
    ]); */

    // set the db content into editor
    quill.setContents(contentArray);

    // when quill is update this function will call
    quill.on('text-change', updateQuill);

    function updateQuill () {
      // get content from the editor as array
      var delta = quill.getContents();

      // convert the content array into string
      var deltaSerialize = JSON.stringify(delta);

      // set serializeContent to hidden textbox for save into db
      $('.textbox').val(deltaSerialize);
    };
  </script>
</body>
</html>