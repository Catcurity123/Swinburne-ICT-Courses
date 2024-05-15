using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Part2_Dependency;
using Part2_Dependency_2;

using System;
using System.IO; // Include the IO namespace to handle file operations
using System.Windows.Forms;

namespace Part2_Form
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void buttonShowMessage_Click(object sender, EventArgs e)
        {
            try
            {
                // Specify the path to the text file
                string filePath = "./Files/Content.txt";

                // Read the content of the file
                string fileContent = File.ReadAllText(filePath);

                // Display the content in a message box
                MessageBox.Show(fileContent);
            }
            catch (Exception ex)
            {
                // Display an error message if something goes wrong
                MessageBox.Show("An error occurred: " + ex.Message);
            }
        }

        private void buttonShowFunction_Click(object sender, EventArgs e)
        {
            try
            {
                // Create an instance of the class from the class library
                Class1 class1 = new Class1();

                // Get the message from the class library
                string message = class1.GetMessage();

                // Display the message in a message box
                MessageBox.Show(message);
            }
            catch (Exception ex)
            {
                // Display an error message if something goes wrong
                MessageBox.Show("An error occurred: " + ex.Message);
            }
        }

        private void buttonShowFunction2_Click(object sender, EventArgs e)
        {
            try
            {
                // Create an instance of the class from the class library
                Class2 class2 = new Class2();

                // Get the message from the class library
                string message = class2.GetMessage();

                // Display the message in a message box
                MessageBox.Show(message);
            }
            catch (Exception ex)
            {
                // Display an error message if something goes wrong
                MessageBox.Show("An error occurred: " + ex.Message);
            }
        }
    }
}

