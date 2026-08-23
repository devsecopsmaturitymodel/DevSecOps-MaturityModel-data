## DSOMM Activity Dependencies

The activities in this DSOMM Model have the following dependencies.

```mermaid
graph LR

0(L2 Basic data leak prevention)
1(L2 AI usage policy)
2(L4 Automated data leak detection for AI interactions)
3(L4 Hallucination detection for AI responses)
4(L4 Secure output handling in AI applications)
5(L3 Input validation for AI systems)
6(L1 Context-aware output encoding)
7(L5 Protection of agent memory against poisoning)
8(L2 Instructed load of security rules)
9(L1 Static load of security rules)
10(L2 Spec-driven development)
11(L2 Inventory of AI agents)
12(L2 Language and framework specific security rules)
13(L1 Version control)
14(L2 Threat modeling rule)
15(L1 Conduction of simple threat modeling on technical level)
16(L3 Audit logging of AI agent actions)
17(L2 Centralized application logging)
18(L3 Decommissioning of AI agents)
19(L3 Least privilege on external systems for AI agents)
20(L3 Evaluation of the trust of used AI components)
21(L2 Evaluation of the trust of used components)
22(L3 Threat modeling of AI components)
23(L4 Anomaly detection for AI agent behavior)
24(L2 Alerting)
25(L4 Dynamic load of security rules)
26(L5 Automated containment of anomalous AI agents)
27(L2 Rate limiting and resource budgets for AI systems)
28(L2 Monitoring of costs)
29(L2 Untrusted workspace handling for AI agents)
30(L1 Usage of sandboxing for AI agents)
31(L2 Permission management for AI agents)
32(L3 Network isolation for AI agents)
33(L4 Human approval for irreversible AI agent actions)
34(L4 Trust boundaries between AI agents)
35(L2 Human review of AI generated plans)
36(L2 Human review of AI generated specifications)
37(L2 Self-verification of AI generated changes)
38(L1 Defined build process)
39(L2 Security unit tests for important components)
40(L2 Static and dynamic analysis of AI generated code)
41(L3 Static analysis for important server side components)
42(L2 Simple Scan)
43(L2 Validation of AI-suggested dependencies)
44(L2 Software Composition Analysis server side)
45(L3 Human review of AI generated code)
46(L3 No verification bypass for AI generated code)
47(L3 Security test generation with AI)
48(L4 Continuous detection of compromised AI components)
49(L3 Test for compromised components)
50(L5 Drift detection for agent instructions and guardrails)
51(L3 Drift detection for deployed configuration)
52(L2 Building and testing of artifacts in virtualized environments)
53(L2 Usage of containers)
54(L2 Pinning of artifacts)
55(L2 SBOM of components)
56(L3 Signing of code)
57(L5 Signing of artifacts)
58(L1 Automated deployment process)
59(L1 Defined deployment process)
60(L1 Inventory of production components)
61(L2 Inventory of production artifacts)
62(L3 Handover of confidential parameters)
63(L2 Environment depending configuration parameters secrets)
64(L3 Inventory of production dependencies)
65(L3 Rolling update on deployment)
66(L4 Canary deployment)
67(L4 Same artifact for environments)
68(L4 Usage of feature toggles)
69(L5 Blue/Green Deployment)
70(L4 Smoke Test)
71(L2 Automated merge of automated PRs)
72(L1 Automated PRs for patches)
73(L3 Automated deployment of automated PRs)
74(L3 Creation of simple abuse stories)
75(L3 Creation of threat modeling processes and standards)
76(L4 Conduction of advanced threat modeling)
77(L5 Creation of advanced abuse stories)
78(L2 Regular security training of security champions)
79(L2 Each team has a security champion)
80(L2 Determining the protection requirement)
81(L2 App. Hardening Level 1)
82(L1 App. Hardening Level 1 50%)
83(L3 App. Hardening Level 2 75%)
84(L4 App. Hardening Level 2)
85(L5 App. Hardening Level 3)
86(L3 Block force pushes)
87(L2 Require a PR before merging)
88(L3 Dismiss stale PR approvals)
89(L3 Require status checks to pass)
90(L2 Central identity provider for human access)
91(L1 Simple access control for systems)
92(L2 Least-privilege access baseline)
93(L2 Account inventory)
94(L2 MFA)
95(L1 MFA for admins)
96(L3 Automated authorization test coverage)
97(L1 Enforce server-side authorization on every request)
98(L3 Automated joiner-mover-leaver provisioning)
99(L3 Fine-Grained Access Controls for authentication and authorization)
100(L3 Use correct OAuth2/OIDC authorization flows)
101(L4 Just-in-time privileged access)
102(L4 Periodic access recertification)
103(L4 Segregation of duties for critical actions)
104(L4 Workload and machine identity)
105(L5 Continuous and risk-adaptive access)
106(L5 Externalized policy-as-code authorization)
107(L2 Backup)
108(L2 Usage of test and production environments)
109(L2 Virtual environments are limited)
110(L3 Immutable infrastructure)
111(L3 Infrastructure as Code)
112(L3 Limitation of system events)
113(L3 Audit of system events)
114(L3 Usage of security by default for components)
115(L3 WAF baseline)
116(L4 Production near environments are used by developers)
117(L4 WAF medium)
118(L5 WAF Advanced)
119(L3 Logging of AI interactions)
120(L3 Visualized logging)
121(L1 Centralized system logging)
122(L5 Correlation of security events)
123(L2 Visualized metrics)
124(L1 Simple application metrics)
125(L1 Simple system metrics)
126(L3 Advanced availability and stability metrics)
127(L3 Deactivation of unused metrics)
128(L3 Targeted alerting)
129(L4 Advanced app. metrics)
130(L4 Coverage and control metrics)
131(L4 Defense metrics)
132(L3 Filter outgoing traffic)
133(L4 Screens with metric visualization)
134(L3 Grouping of metrics)
135(L5 Metrics are combined with tests)
136(L2 Patching mean time to resolution via PR)
137(L3 Generation of response statistics)
138(L3 Usage of a vulnerability management system)
139(L4 Patching mean time to resolution via production)
140(L2 Artifact-based false positive treatment)
141(L1 Simple false positive treatment)
142(L3 Fix based on accessibility)
143(L1 Treatment of defects with high or critical severity)
144(L3 Global false positive treatment)
145(L2 Exploit likelihood estimation)
146(L3 Office Hours)
147(L2 Coverage of client side dynamic components)
148(L2 Usage of different roles)
149(L3 Coverage of hidden endpoints)
150(L3 Coverage of more input vectors)
151(L3 Coverage of sequential operations)
152(L4 Usage of multiple scanners)
153(L5 Coverage of service to service communication)
154(L2 Test for exposed services)
155(L2 Isolated networks for virtual environments)
156(L2 Test network segmentation)
157(L3 Test for unauthorized installation)
158(L2 Test for Time to Patch)
159(L2 Test libyear)
160(L3 API design validation)
161(L3 Software Composition Analysis client side)
162(L3 Static analysis for important client side components)
163(L3 Test for Patch Deployment Time)
164(L4 Static analysis for all self written components)
165(L4 Usage of multiple analyzers)
166(L5 Dead code elimination)
167(L5 Exclusion of source code duplicates)
168(L5 Static analysis for all components/libraries)
169(L4 Correlate known vulnerabilities in infrastructure with new image versions)
170(L2 Usage of a maximum lifetime for images)
171(L4 Test of infrastructure components for known vulnerabilities)


1 --> 0
1 --> 11
1 --> 20
0 --> 2
4 --> 3
5 --> 4
5 --> 7
6 --> 4
6 --> 115
9 --> 8
9 --> 12
9 --> 25
10 --> 8
10 --> 12
10 --> 14
10 --> 25
10 --> 35
10 --> 36
13 --> 10
13 --> 59
15 --> 14
15 --> 22
15 --> 74
15 --> 75
15 --> 76
11 --> 16
11 --> 18
17 --> 16
17 --> 119
17 --> 120
19 --> 18
19 --> 26
19 --> 34
19 --> 45
21 --> 20
21 --> 157
16 --> 23
16 --> 33
16 --> 34
24 --> 23
24 --> 27
24 --> 17
24 --> 122
24 --> 128
14 --> 25
14 --> 47
8 --> 25
23 --> 26
28 --> 27
30 --> 29
30 --> 32
31 --> 19
31 --> 33
36 --> 35
38 --> 37
38 --> 46
38 --> 54
38 --> 55
38 --> 56
38 --> 57
38 --> 58
38 --> 59
38 --> 67
38 --> 114
38 --> 42
38 --> 44
38 --> 159
38 --> 161
38 --> 162
38 --> 41
38 --> 163
38 --> 49
38 --> 166
38 --> 167
39 --> 37
41 --> 40
41 --> 46
41 --> 164
41 --> 168
42 --> 40
42 --> 46
42 --> 148
42 --> 153
44 --> 43
44 --> 145
44 --> 49
44 --> 165
45 --> 47
20 --> 48
49 --> 48
7 --> 50
51 --> 50
53 --> 52
53 --> 109
54 --> 57
59 --> 58
59 --> 107
59 --> 108
58 --> 60
58 --> 61
58 --> 51
58 --> 65
58 --> 66
58 --> 116
58 --> 70
60 --> 61
60 --> 80
60 --> 142
60 --> 44
60 --> 160
60 --> 161
60 --> 162
60 --> 41
60 --> 164
60 --> 168
63 --> 62
61 --> 64
55 --> 64
67 --> 68
70 --> 69
72 --> 71
72 --> 136
72 --> 139
72 --> 158
72 --> 163
71 --> 73
75 --> 74
75 --> 76
74 --> 77
79 --> 78
79 --> 138
82 --> 81
81 --> 83
83 --> 84
84 --> 85
87 --> 86
87 --> 88
87 --> 89
91 --> 90
91 --> 92
93 --> 92
95 --> 94
95 --> 101
97 --> 96
92 --> 98
92 --> 99
92 --> 101
92 --> 102
92 --> 103
92 --> 104
90 --> 98
90 --> 100
98 --> 102
101 --> 105
99 --> 105
99 --> 106
102 --> 105
111 --> 110
111 --> 116
113 --> 112
115 --> 117
115 --> 118
121 --> 120
120 --> 122
123 --> 24
123 --> 126
123 --> 113
123 --> 127
123 --> 129
123 --> 130
123 --> 131
124 --> 28
124 --> 123
124 --> 126
124 --> 129
125 --> 28
125 --> 123
132 --> 131
134 --> 133
134 --> 135
138 --> 137
138 --> 144
136 --> 139
141 --> 140
143 --> 142
140 --> 144
145 --> 138
145 --> 161
146 --> 138
148 --> 147
148 --> 149
148 --> 150
148 --> 151
148 --> 152
155 --> 154
155 --> 156
162 --> 164
162 --> 168
161 --> 165
164 --> 165
170 --> 169
170 --> 171

O --> 1
O --> 5
O --> 6
O --> 9
O --> 13
O --> 15
O --> 21
O --> 30
O --> 31
O --> 38
O --> 39
O --> 53
O --> 63
O --> 72
O --> 79
O --> 82
O --> 87
O --> 91
O --> 93
O --> 95
O --> 97
O --> 111
O --> 121
O --> 124
O --> 125
O --> 132
O --> 134
O --> 141
O --> 143
O --> 146
O --> 155
O --> 170
```
