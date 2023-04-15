Imports Oracle.ManagedDataAccess.Client
Imports System.Data.SqlClient

Public Class Form2
    '---------------------------------------- NAVIGATION AND CLEARING TEXT ----------------------------------------'
    Public Sub ClearTextBoxes(frm As Form)
        For Each Control In frm.Controls
            If TypeOf Control Is TextBox Then
                Control.Text = ""
            End If
        Next Control
    End Sub

    Private Sub Button1_Click(sender As Object, e As EventArgs) Handles Button1.Click
        Call ClearTextBoxes(Me)
    End Sub

    Private Sub btnNext_Click(sender As Object, e As EventArgs) Handles btnNext.Click
        Form3.Show()
        Me.Hide()
    End Sub

    Private Sub Button2_Click(sender As Object, e As EventArgs) Handles Button2.Click
        Form1.Show()
        Me.Hide()
    End Sub

    '---------------------------------------- CONNECTION TO SWINBURNE DATABASE ----------------------------------------'
    Function GetConnectionString() As String
        Dim vConnStr As String
        vConnStr = "Data Source=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)"
        vConnStr = vConnStr & "(HOST=feenix-oracle.swin.edu.au)(PORT=1521))"
        vConnStr = vConnStr & "(CONNECT_DATA=(SID=DMS)));"
        vConnStr = vConnStr & "User Id=s103802759;"
        vConnStr = vConnStr & "Password=200802;"
        Return vConnStr
    End Function

    Function CreateConnection() As OracleConnection
        Dim rvConn As New OracleConnection
        rvConn.ConnectionString = GetConnectionString()
        Return rvConn
    End Function



    '---------------------------------------- ADD PRODUCT  ---------------------------------------- '
    Private Sub btnAdd_Click(sender As Object, e As EventArgs) Handles btnAdd.Click
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        Dim cmd As New OracleCommand
        cmd.Connection = rvConn

        cmd.CommandType = CommandType.StoredProcedure
        cmd.CommandText = "ADD_PRODUCT_TO_DB"
        cmd.Parameters.Add("pprodid", txtProductID.Text)
        cmd.Parameters.Add("pprodname", txtProductName.Text)
        cmd.Parameters.Add("pprice", txtProductPrice.Text)

        Try
            rvConn.Open()
            cmd.ExecuteNonQuery()
            MessageBox.Show("Product added OK")
        Catch ex As Exception
            MessageBox.Show(ex.Message)
        Finally
            rvConn.Close()
        End Try

    End Sub

    '---------------------------------------- GET PRODUCT STRING ---------------------------------------- '
    Private Sub btn_Click(sender As Object, e As EventArgs) Handles btnGetProductString.Click
        GET_PROD_STRING_FROM_DB()
    End Sub

    Private Sub GET_PROD_STRING_FROM_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("GET_PROD_STRING_FROM_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "vStringReturn"
        paramOracle.DbType = DbType.String
        paramOracle.Size = 20000

        paramOracle.Direction = ParameterDirection.ReturnValue
        cmd.Parameters.Add(paramOracle)

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pprodid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtProductID.Text
        cmd.Parameters.Add(paramOracle)


        Try

            cmd.ExecuteNonQuery()
            Dim vStr As String
            vStr = cmd.Parameters.Item("vStringReturn").Value.ToString
            txtReturnedString.Text = txtReturnedString.Text & Environment.NewLine & vStr


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- Update Product Info ---------------------------------------- '
    Private Sub btnUpdate_Click(sender As Object, e As EventArgs) Handles btnUpdate.Click
        UPD_PROD_SALESYTD_IN_DB()
    End Sub

    Private Sub UPD_PROD_SALESYTD_IN_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("UPD_PROD_SALESYTD_IN_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pprodid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtProductID.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)


        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pamt"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtUpdatedSale.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            MessageBox.Show("PRODUCT SALES UPDATED OK")

        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- Delete All Customer ---------------------------------------- '
    Private Sub btnDeleteAllCustomer_Click(sender As Object, e As EventArgs) Handles btnDeleteAllCustomer.Click
        DELETE_ALL_PRODUCTS_FROM_DB()
    End Sub

    Private Sub DELETE_ALL_PRODUCTS_FROM_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("DELETE_ALL_PRODUCTS_FROM_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "vRowDeleted"
        paramOracle.DbType = DbType.Int16
        paramOracle.Size = 20000

        paramOracle.Direction = ParameterDirection.ReturnValue
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            Dim retInt As Int16
            retInt = cmd.Parameters.Item("vRowDeleted").Value.ToString
            txtDeletedRows.Text = txtDeletedRows.Text & Environment.NewLine & retInt


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub


    '---------------------------------------- Get All Product Info ---------------------------------------- '
    Private Sub btnGetAllProd_Click(sender As Object, e As EventArgs) Handles btnGetAllProd.Click
        GET_ALL_CUST()
    End Sub

    Private Sub GET_ALL_CUST()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        Dim cmd As New OracleCommand("GET_PACK.GETALLPROD", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim ParamOracle As OracleParameter
        ParamOracle = New OracleParameter
        ParamOracle.ParameterName = "ProdCursor"
        ParamOracle.OracleDbType = OracleDbType.RefCursor
        ParamOracle.Direction = ParameterDirection.Output
        cmd.Parameters.Add(ParamOracle)

        Try
            rvConn.Open()
            Dim OracleRead As OracleDataReader
            OracleRead = cmd.ExecuteReader()
            If OracleRead.HasRows = True Then
                Dim CustString
                CustString = ""

                Do While OracleRead.Read()
                    CustString = CustString & ("Prod ID: " & OracleRead("PRODID") & " Name: " & OracleRead("PRODNAME") & " PRICE: " & OracleRead("SELLING_PRICE") & " SalesYTD " & OracleRead("SALES_YTD")) & vbCrLf
                Loop
                cmd.CommandText = " BEGIN COMMIT; END;"
                cmd.CommandType = CommandType.Text
                txtProdInfo.Text = txtProdInfo.Text & Environment.NewLine & CustString
            Else
                MessageBox.Show("No rows found")
            End If
        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
            cmd.CommandText = " BEGIN ROLLBACK; END;"
            cmd.CommandType = CommandType.Text
        Finally
            rvConn.Close()
        End Try
    End Sub


End Class