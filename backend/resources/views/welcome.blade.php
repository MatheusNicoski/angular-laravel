<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>API</title>
  </head>
  <body>
    
    <div class="container">
        
        @foreach ($routes as $path => $route)

            <div class="list-group mt-5">

                <span class="list-group-item list-group-item-action bg-dark text-white">{{ $path }}</span>

                @foreach ($route as $method => $item)

                    @foreach ($item['uri'] as $uri)

                        <span class="list-group-item list-group-item-action">
                            <span class="badge badge-{{ $item['color'] }}">{{ $method }}</span>
                            {{ $uri }},
                            uri: <span class="badge badge-secondary">{{ $url . $prefix . $uri }}</span>
                        </span>

                    @endforeach

                @endforeach

            </div>

        @endforeach
        

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>

        const areBracesBalanced = brs => {
            let expectCloseStack = [];
        
            return [...brs].every(b => {
                switch (b) {
                case "(": return expectCloseStack.push(")");
                case "[": return expectCloseStack.push("]");
                case "{": return expectCloseStack.push("}");

                case ")":
                case "]":
                case "}":
                    return expectCloseStack.pop() === b;
                }
            }) && !expectCloseStack.length;
        };

        console.log([
        '● (){}[] is valid -> ' + areBracesBalanced("(){}[]"),
        '● [{()}](){} is valid -> ' + areBracesBalanced("[{()}](){}"),
        '● []{() is not valid -> ' + areBracesBalanced("[]{()"),
        '● [{)] is not valid -> ' + areBracesBalanced("[{)]")
        ]);


    </script>
  </body>
</html>