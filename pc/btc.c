#include <stdio.h>
#include <windows.h>
#include <string.h>
#include <conio.h>
#include <time.h>

/**
 * 函数声明
 */
char splice();		// 域名拼接
char openWindow();	// 打开浏览器
void printTime();	// 打印当前时间
void keybdEvent();	// 模拟alt+f4

/**
 * 入口函数
 */
void main() {
	char host[128];

	printf("Examples of the domain name: iam671.cn\n");
	printf("Please enter your domain name: ");
	gets(host);	// 输入域名

	splice(host);

	system("pause");
}

/**
 * 域名拼接
 *
 * @param host 域名
 */
char splice(char *host) {
	char open[128] = "http://";

	strcat(host, "/Float/FloatSet/window");
	strcat(open, host);

	openWindow(open);
}

/**
 * 打开浏览器
 *
 * @param host 域名
 */
char openWindow(char *host) {
	char ch;
	int  i = 0;
	int  time = 0;	// 时间s

	// 请输入时间单位秒
	printf("Please ebter the beat time unit for seconds(60): ");
	scanf("%d", &time);

	do {
		// 非阻塞式键盘监听
		if (kbhit()) {
			ch = getch();
			if (ch == 27) {
				printf("stop procedure success!\n");
				break;
				return 0;	// 跳出循环
			}
		}

		// 打开浏览器
		int iRet = (int)ShellExecute(NULL, "open", host, NULL, NULL, SW_MINIMIZE);
		if (iRet >= 32) {
			// 描述
			printf("\nyou type %ds to beat once.\n", time);
			printf("time:");
			printTime();	// 当前时间
			printf(" open success!\n");
			printf("Press the ESC programe to stop automatically.\n");
			
		} else {
			printf(" open failed!\n");
		}

		Sleep(1000 * time);	// 延时
		keybdEvent();		// alt+f4关闭浏览器
		Sleep(1000 * 0.5);

	} while(1);
}

/**
 * 打印出系统当前时间
 */
void printTime() {
	time_t timep;
	struct tm *p;
	time(&timep);
	p = localtime(&timep);

	printf("%d/", 1900+p->tm_year);
	printf("%d/", 1+p->tm_mon);
	printf("%d ", p->tm_mday);
	printf("%d:", p->tm_hour);
	printf("%d:", p->tm_min);
	printf("%d", p->tm_sec);
}

/**
 * 模拟alt+f4
 */
void keybdEvent() {
	keybd_event(18, 0, 0, 0);
	keybd_event(115, 0, 0, 0);
	keybd_event(115, 0, KEYEVENTF_KEYUP, 0);
	keybd_event(18, 0, KEYEVENTF_KEYUP, 0);
}




