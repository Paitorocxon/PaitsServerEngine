Imports System.Net

Module Module1

    Sub Main()
        Console.Title = "PSE 1.0.0"
TypeAddress:
        Console.Title = "PSE 1.0.0"
        Console.Write("URL(http/https):")
        Dim Addresse As String = Console.ReadLine

        Dim req As System.Net.WebRequest
        Dim res As System.Net.WebResponse
        Try

            req = System.Net.WebRequest.Create(Addresse)
        Catch ex As Exception
            Console.WriteLine("Error!")
            GoTo TypeAddress

        End Try

        Try
            res = req.GetResponse()
        Catch e As WebException
            GoTo TypeAddress
        End Try
login:
        Console.Title = "PSE 1.0.0"
        Console.Write("username:")
        Dim Username As String = Console.ReadLine

        Console.Write("password:")
        Dim oldFore As ConsoleColor = Console.ForegroundColor
        Console.ForegroundColor = Console.BackgroundColor

        Dim password As String = Console.ReadLine
        Console.ForegroundColor = oldFore


        Try
            Dim client As WebClient = New WebClient
            Dim reply As String = client.DownloadString(Addresse & "/pse.php?user=" & Username & "&password=" & password)
            Console.WriteLine(reply)
            If reply.Contains("<!--[SERVER] 0,403-->") Then
                Console.WriteLine("Wrong password!")
                GoTo login
            ElseIf reply.Contains("<!--[SERVER] 0,404-->") Then
                Console.WriteLine("User does'nt exists!")
                GoTo login
            End If
            If reply.Contains("[SERVER]") Then
            Else
                Console.ForegroundColor = ConsoleColor.Red
                Console.WriteLine("can not mount! Is pse.php available?")
                Console.ForegroundColor = oldFore

                GoTo TypeAddress
            End If
        Catch ex As Exception
            Console.WriteLine("FATAL ERROR!")
            GoTo TypeAddress

        End Try
        Console.ForegroundColor = ConsoleColor.Green
        Console.WriteLine("Logged in an connected to " & Addresse)
        Console.ForegroundColor = oldFore


loggedin:
        Console.Title = "PSE 1.0.0 [" & Username & "@" & Addresse & "]"
        Console.ForegroundColor = ConsoleColor.DarkGray
        Console.Write(Username)
        Console.Write("@" & Addresse)
        Console.ForegroundColor = ConsoleColor.DarkRed
        Console.Write("-# ")
        Console.ForegroundColor = oldFore


        Dim command As String = Console.ReadLine
        If command = "" Then
            GoTo loggedin

        End If

        Try
            Dim client As WebClient = New WebClient
            Dim reply As String = client.DownloadString(Addresse & "/pse.php?user=" & Username & "&password=" & password & "&command=" & command)
            Console.ForegroundColor = ConsoleColor.Cyan

            Console.WriteLine(reply)
            Console.ForegroundColor = oldFore

        Catch ex As Exception
            Console.WriteLine("FATAL ERROR!")
            GoTo TypeAddress

        End Try

        GoTo loggedin



    End Sub

End Module
