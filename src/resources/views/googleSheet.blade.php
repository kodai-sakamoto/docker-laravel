<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Sheets 更新</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <a href="{{ url('/') }}">ホームへ戻る</a>
    <h1>Google Sheets にデータを追加</h1>
    <button id="updateSheet">データ追加</button>
    <p id="status"></p>

    <script>
        $(document).ready(function() {
            $("#updateSheet").click(function() {
                $("#status").text("処理中...");

                $.ajax({
                    url: "{{ route('test.google.sheets') }}",
                    type: "GET",
                    success: function(response) {
                        $("#status").text(response.message);
                    },
                    error: function(xhr) {
                        $("#status").text("エラーが発生しました: " + xhr.responseJSON.error);
                    }
                });
            });
        });
    </script>
</body>
</html>