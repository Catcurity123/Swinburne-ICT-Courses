Imports Oracle.ManagedDataAccess.Client
Imports System.Data.SqlClient


Public Class Form3
    '---------------------------------------- NAVIGATION AND CLEARING TEXT ----------------------------------------'
    Private Sub btnNext_Click(sender As Object, e As EventArgs) Handles btnNext.Click
        Form2.Show()
        Me.Hide()
    End Sub

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

    '---------------------------------------- ADD COMPLEX SALE ---------------------------------------- '
    Private Sub btnUpdate_Click(sender As Object, e As EventArgs) Handles btnUpdate.Click
        ADD_COMPLEX_SALE_TO_DB()
    End Sub

    Private Sub ADD_COMPLEX_SALE_TO_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("ADD_COMPLEX_SALE_TO_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pcustid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtCustomerID.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pprodid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtProductID.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pqty"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtQuantity.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pdate"
        paramOracle.DbType = DbType.String
        paramOracle.Value = txtDate.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            MessageBox.Show("SALES UPDATED OK")


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub


    '---------------------------------------- OOUNT SALE ---------------------------------------- '
    Private Sub btnCountSale_Click(sender As Object, e As EventArgs) Handles btnCountSale.Click
        COUNT_PRODUCT_SALES_FROM_DB()
    End Sub

    Private Sub COUNT_PRODUCT_SALES_FROM_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("COUNT_PRODUCT_SALES_FROM_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "vSale"
        paramOracle.DbType = DbType.Int16
        paramOracle.Size = 20000
        paramOracle.Direction = ParameterDirection.ReturnValue
        cmd.Parameters.Add(paramOracle)

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pdays"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtDays.Text
        cmd.Parameters.Add(paramOracle)


        Try
            cmd.ExecuteNonQuery()
            Dim vStr As String
            vStr = cmd.Parameters.Item("vSale").Value.ToString
            txtSaleSince.Text = txtSaleSince.Text & Environment.NewLine & vStr

        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- DELETE SALE ---------------------------------------- '
    Private Sub btnDeleteSale_Click(sender As Object, e As EventArgs) Handles btnDeleteSale.Click
        DELETE_SALE_FROM_DB()
    End Sub

    Private Sub DELETE_SALE_FROM_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("DELETE_SALE_FROM_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "vMinSaleId"
        paramOracle.DbType = DbType.Int16
        paramOracle.Size = 20000

        paramOracle.Direction = ParameterDirection.ReturnValue
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            Dim retInt As Int16
            retInt = cmd.Parameters.Item("vMinSaleId").Value.ToString
            txtMinSaleID.Text = txtMinSaleID.Text & Environment.NewLine & retInt


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub



    '---------------------------------------- DELETE ALL SALE ---------------------------------------- '
    Private Sub btnDeleteAllSale_Click(sender As Object, e As EventArgs) Handles btnDeleteAllSale.Click
        DELETE_ALL_SALES_FROM_DB()
    End Sub

    Private Sub DELETE_ALL_SALES_FROM_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("DELETE_ALL_SALES_FROM_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure



        Try
            cmd.ExecuteNonQuery()
            MessageBox.Show("DELETED ALL SALES")


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- GET ALL SALE ---------------------------------------- '
    Private Sub btnGetAllSale_Click(sender As Object, e As EventArgs) Handles btnGetAllSale.Click
        GET_ALL_SALE()
    End Sub

    Private Sub GET_ALL_SALE()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        Dim cmd As New OracleCommand("GET_PACK.GETALLSALE", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim ParamOracle As OracleParameter
        ParamOracle = New OracleParameter
        ParamOracle.ParameterName = "SaleCursor"
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
                    Dim SaleAmount As Int16
                    SaleAmount = OracleRead("QTY") * OracleRead("PRICE")
                    CustString = CustString & ("Sale ID: " & OracleRead("SALEID") & " CustID: " & OracleRead("CUSTID") & " ProdID: " & OracleRead("PRODID") & " Date " & OracleRead("SALEDATE") & " Amount " & SaleAmount.ToString) & vbCrLf
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