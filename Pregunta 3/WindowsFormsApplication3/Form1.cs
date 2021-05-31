using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Drawing.Imaging;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApplication3
{
    public partial class Form1 : Form
    {
        int cR, cG, cB;
        int cRt, cGt, cBt;

        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            openFileDialog1.ShowDialog();
            Bitmap bmp = new Bitmap(openFileDialog1.FileName);
            pictureBox1.Image = bmp;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            c = bmp.GetPixel(0,0);
            textBox1.Text = c.R.ToString();
            textBox2.Text = c.G.ToString();
            textBox3.Text = c.B.ToString();
        }

        private void pictureBox1_Click(object sender, EventArgs e)
        {

        }

        private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            c = bmp.GetPixel(e.X, e.Y);
            cR = c.R; cG = c.G; cB=c.B;

            cRt = 0; cGt = 0; cBt = 0;
            for (int i = e.X; i<e.X+10; i++)
                for (int j = e.Y; j < e.Y + 10; j++)
                {
                    c = bmp.GetPixel(i, j);
                    cRt = c.R+cRt; cGt = c.G+cGt; cBt = c.B+cBt;
                }
            cRt = cRt / 100;
            cGt = cGt / 100;
            cBt = cBt / 100;
            textBox1.Text = c.R.ToString()+ " "+cRt.ToString();
            textBox2.Text = c.G.ToString()+ " "+cGt.ToString();
            textBox3.Text = c.B.ToString() + " " + cBt.ToString();
        }

   
        private void button9_Click(object sender, EventArgs e)
        {
            int rango = 20;
            cR = 12;
            cG = 43;
            cB = 64;
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 0; i < bmp.Width; i++)
                for (int j = 0; j < bmp.Height; j++)
                {
                    c = bmp.GetPixel(i, j);
                    if (((cR - rango <= c.R) && (c.R <= cR + rango)) && ((cG - rango <= c.G) && (c.G <= cG + rango)) && ((cB - rango <= c.B) && (c.B <= cB + rango)))
                        bmp2.SetPixel(i, j, c);
                    else
                        bmp2.SetPixel(i, j, Color.White);
                }
            pictureBox2.Image = bmp2;
        }
        private void button10_Click(object sender, EventArgs e)
        {
            int rango = 60;
            cR = 139;
            cG = 131;
            cB = 118;
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 0; i < bmp.Width; i++)
                for (int j = 0; j < bmp.Height; j++)
                {
                    c = bmp.GetPixel(i, j);
                    if (((cR - rango <= c.R) && (c.R <= cR + rango)) && ((cG - rango <= c.G) && (c.G <= cG + rango)) && ((cB - rango <= c.B) && (c.B <= cB + rango)))
                        bmp2.SetPixel(i, j, c);
                    else
                        bmp2.SetPixel(i, j, Color.White);
                }
            pictureBox2.Image = bmp2;
        }
        private void button11_Click(object sender, EventArgs e)
        {
            int rango = 20;
            cR = 33;
            cG = 56;
            cB = 36;

            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap bmp2 = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 0; i < bmp.Width; i++)
                for (int j = 0; j < bmp.Height; j++)
                {
                    c = bmp.GetPixel(i, j);
                    if (((cR - rango <= c.R) && (c.R <= cR + rango)) && ((cG - rango <= c.G) && (c.G <= cG + rango)) && ((cB - rango <= c.B) && (c.B <= cB + rango)))
                        bmp2.SetPixel(i, j, c);
                    else
                        bmp2.SetPixel(i, j, Color.White);
                }
            pictureBox2.Image = bmp2;
        }

    }
}
